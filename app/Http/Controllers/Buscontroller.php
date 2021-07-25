<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bus;
use App\Models\Busallocation;
use App\Models\Driver;
use App\Models\Route;
use App\Models\Station;
use App\MOdels\TicketBooking;
use App\Models\Pickanddrop;
use App\Models\Shedule;
use App\Models\Routemap;
use App\Rules\CheckStation;
use App\Rules\lowerDate;
use Illuminate\Support\Facades\DB;
use Symfony\Component\VarDumper\VarDumper;
use DateTime;
use DatePeriod;
use DateInterval;
use Carbon\Carbon;
use Exception;

use function PHPSTORM_META\elementType;

class Buscontroller extends Controller
{

    public function searchbus(Request $req)
    {
        $stationdata= Station::get('sname');
        $stations=[];
        foreach ($stationdata as  $value) {
            array_push($stations,$value->sname);
        }
        session()->put('stationsname',$stations);
        $validate=$req->validate([
            'start'=>['required',new CheckStation],
            'end'=>['required',new CheckStation],
            'date'=>['required',new lowerDate],
        ]);
        // try{
            $start=$req->start;
            $end=$req->end;
            $date=$req->date;
            $date2 = date('Y-m-d'); 
            $date3 = strtotime($date); 
            $date4= date('Y-m-d', $date3); 
            
            //echo $date2;
            $routedata=$this->getrouteData($start,$end);    //route deatils
            $routedataarray= $this->getData($routedata,'rid');;//separating rid
            $sheduledata=$this->findShedule($routedataarray,$date4,$date2);//fincding shedule
    
            $sheduledataarray= $this->getData($sheduledata,'rid');;//separating rid
            $busdataarray= $this->getData($sheduledata,'bid');;// separating bid
            //return $busdataarray;
            $busallocationarray=$this->getData($sheduledata,'baid');//separating baid
            
             $starttime=$this->getTime($sheduledataarray,$start);// rid and tfromp
             $endtime=$this->getTime($sheduledataarray,$end);//return $sheduledata;
             $esid=Station::where('sname',$end)->get('sid');
                $sid=$esid[0]->sid;
                $delayarray=DB::table('routemaps')
                ->whereIn('rid',$routedataarray)
                ->select('rid',DB::raw('sum(delay) AS delay'))
                ->groupBy('rid')
                ->get();
    
                
                //return $delayarray;
                foreach ($sheduledata as $key => $value) {
                foreach ($starttime as $key1 => $value1) {
                    if($value1->rid==$value->rid)
                    {
                        $time=strtotime($value->starttime);
                        $time = new DateTime($value->starttime);
                        $stime=$time->add(new DateInterval('PT' . $value1->tfromp . 'M'));
                        $value->starttime=$stime->format('H:i:s');
                    }
                }
             }
             foreach ($sheduledata as $key => $value) {
                foreach ($endtime as $key1 => $value1) {
                    if($value1->rid==$value->rid)
                    {
                       // $time=strtotime($value->starttime);
                       // $sname=Route::where('rid',$value->rid)->get('from_st')->first();
                        //$sid=Station::where('sname',$sname->from_st)->get('sid')->first();

                        $time = new DateTime($value->starttime);
                        $stime=$time->add(new DateInterval('PT' . $value1->tfromp . 'M'));
                        $value->endingtime=$stime->format('H:i:s');
                    }
                }
             }
             foreach ($sheduledata as $key => $value) {
                foreach ($delayarray as $key1 => $value1) {
                    if($value1->rid==$value->rid)
                    {
                        //$time=strtotime($value->starttime);
                        $time = new DateTime($value->endingtime);
                        $stime=$time->add(new DateInterval('PT' . $value1->delay . 'M'));
                        $value->endingtime=$stime->format('H:i:s');
                    }
                }
             }
             $stationname = Station::get('sname');
             $stationnames=[];
             foreach ($stationname as  $value) {
                 array_push($stationnames,$value->sname);
             }
             $req->session()->put('starting', $start);
             $req->session()->put('ending', $end);
             $req->session()->put('date', $date);  
            if($sheduledata->isEmpty())
            {
                
                return view('bus',['stations'=>$stationnames])->with('errmsg','No Bus For This Route');;
    
            }
            else
            { 
                $distance=$this->calDistance($start,$end);
                $price=$this->calPrice($distance);
                $busdata=Bus::wherein('bid',$busdataarray)->get();
                $seatarray=TicketBooking::whereIn('baid',$busallocationarray)->select(array('baid','seatno','gender','startstation','endstation'))->get();
               
             //   return $sheduledata;
                //$sheduledata=$this->addData($sheduledata,$starttime,'rid','tfromp');
                foreach ($sheduledata as $key => $value) {
                        $value->price=$price;
                        $value->start=$start;
                        $value->end=$end;
                     }
    
                     foreach ($sheduledata as $key => $value) {
                        $twelve="24:00:00";
                        $zero="00:00:00";
                       // return $value->endingtime;
                        $start_datetime = new DateTime(date('Y-m-d').' '. $value->starttime);
                        $end_datetime = new DateTime(date('Y-m-d').' '. $value->endingtime);
                        if($value->starttime>$value->endingtime)
                        {
                            $date1 = new DateTime($date);
                            $starttime=Carbon::parse($date." ".$value->starttime);
                            $date1->modify('+1 day');
                            $date2=$date1->format('Y-m-d') ;
                            $endtime=Carbon::parse($date2." ".$value->endingtime);
                            $totalduration=$starttime->diff($endtime)->format('%H:%I:%S');
                          }
                        else
                        {
                            $starttime=Carbon::parse($date." ".$value->starttime);
                            $endtime=Carbon::parse($date." ".$value->endingtime);
                            $totalduration=$starttime->diff($endtime)->format('%H:%I:%S');
                            $date2=$value->startdate;
                            
                        } 
                       // return $date2;
                        $value->enddate=$date2;
                        $value->total=$totalduration;
                        
                    }
    
                    
                    $busdata=Bus::whereIn('bid',$busdataarray)
                    ->get();
                   foreach ($sheduledata as  $value) {
                       foreach ($busdata as  $value1) {
                           if($value->bid==$value1->bid)
                           {
                                $value->number=$value1->number;
                                $value->capacity=$value1->capacity;
                                $value->isAc=$value1->isAc;
                                $value->isWifi=$value1->isWifi;
                                $value->isSleeper=$value1->isSleeper;
                           }
                       }
                   } 
                   foreach ($sheduledata as  $shedule) {
                    $seat=[];
                    $female=[];
                    foreach ($seatarray as  $value) {
                        if($shedule->baid==$value->baid)
                        {   
                            $sheduleid=Busallocation::where('baid',$value->baid)->get('shid')->first();
                            $routeid=Shedule::Where('shid',$sheduleid['shid'])->get('rid')->first();
                            $endid=Station::Where('sname',$value->endstation)->get('sid')->first();
                            $startid=Station::where('sname',$start)->get('sid')->first();
                            $endstationorder=Routemap::where('sid',$endid['sid'])->where('rid',$routeid['rid'])->get('sorder')->first();
                            $startstationorder=Routemap::where('sid',$startid['sid'])->where('rid',$routeid['rid'])->get('sorder')->first();
                            if($startstationorder['sorder']<$endstationorder['sorder'])
                            {
                                if($value->gender=="female")
                                {
                                    array_push($female,$value->seatno);
                                }
                                else 
                                {
                                    array_push($seat,$value->seatno);
                                }
                            }
                     }
                        
                    }
                    $shedule->seats=$seat;
                    $shedule->female=$female;
                    $shedule->available=$shedule->capacity-sizeof($seat)-sizeof($female);
                }
                foreach ($sheduledata as  $shedule) {
                    if($shedule->isAc==true)
                    {
                        
                        $shedule->price=intval($shedule->price)+100;
                    }
                    if($shedule->isWifi==true)
                    {
                        $shedule->price=intval($shedule->price)+50;
                    }
                    if($shedule->isSleeper==true)
                    {
                        $shedule->price=intval($shedule->price)+70;
                    }
                }          
                   return view('bus',array('shedules' => $sheduledata,'seats' => $seatarray,'stations'=>$stationnames));
            }
        // }catch(Exception $e)
        // {
        //     abort('404');
        // }
      
    }
    function addData($sheduledata,$child,$field,$assign)
    {
        foreach ($sheduledata as $key => $value) {
            foreach ($child as $key1 => $value1) {
                if($value->$field == $value1->$field)
                {
                    $value->$assign=$value1->$assign;
                }
             }
        }
        return $sheduledata;
    }
    function getData($sheduledata,$riid)
    {
        $dataarray=[];
        foreach ($sheduledata as $key => $value) {
            array_push($dataarray,$value->$riid);
           } 
        return $dataarray;
    }

    function calPrice($distance)
    {
         if($distance<50)
         {
            $price=100;
         }
         else if($distance>50 && $distance<=100)
         {
             $price=200;
         }
         else if($distance>100 && $distance<=150)
         {
             $price=300;
         }
         else if($distance>150 && $distance<=200)
         {
             $price=400;
         }
         else if($distance>200 && $distance<=300)
         {
            $price=500;
         }
         else
         {
             $price=600;
         }
         return $price;
    }

    function calDistance($start,$end)
    {
        $startcoordinate=Station::where('sname','=',$start)->select(array('latitude','longitude'))->first();
        $endcoordinate=Station::where('sname','=',$end)->select(array('latitude','longitude'))->first();
        $curlSession = curl_init();
        curl_setopt($curlSession, CURLOPT_URL, "https://dev.virtualearth.net/REST/v1/Routes/DistanceMatrix?origins=$startcoordinate->latitude,$startcoordinate->longitude&destinations=$endcoordinate->latitude,$endcoordinate->longitude&travelMode=driving&key=[Your Key]");
        curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
        $jsonData = json_decode(curl_exec($curlSession));
        $distance= $jsonData->resourceSets[0]->resources[0]->results[0]->travelDistance;
        curl_close($curlSession);  
        return $distance;    
    }

    function findShedule($routedata,$date4,$date2)
    {
        if($date4==$date2)
        {
            date_default_timezone_set('Asia/Kolkata');
            $t=date('H:i:s');
            $data=DB::table('shedules','sh')
            ->join('busallocations as ba','ba.shid','=','sh.shid')
            ->whereIn('sh.rid', $routedata)
            ->where('sh.starttime','>',$t)
            ->where('ba.startdate','=',$date4)
            ->select(array('ba.baid','ba.bid','ba.startdate','sh.starttime','sh.rid'))
            ->get();
        }
        else{
            date_default_timezone_set('Asia/Kolkata');
            $t=date('H:i:s');
            $data=DB::table('shedules','sh')
            ->join('busallocations as ba','ba.shid','=','sh.shid')
            ->whereIn('sh.rid', $routedata)
            ->where('ba.startdate','=',$date4)
            ->select(array('ba.baid','ba.bid','ba.startdate','sh.starttime','sh.rid'))
            ->get();
        }
        return $data;
    }

    function getTime($sheduledataarray,$start)
    {
        $starttime=DB::table('routemaps as r')->join('stations as s','s.sid','=','r.sid')
         ->whereIn('r.rid',$sheduledataarray)
         ->where('s.sname',$start)
         ->select(array('r.tfromp','r.rid'))
         ->get();
         return $starttime;
    }
    function getRoutedata($start,$end)
    {
        $data=DB::table('routes',  'r')
        ->join('routemaps AS rs', 'rs.rid', '=', 'r.rid')
        ->join('stations AS ss', 'ss.sid', '=', 'rs.sid')
        ->join('routemaps AS re', 're.rid', '=', 'r.rid')
        ->join('stations AS se', 'se.sid', '=', 're.sid')
        ->where('ss.sname', '=', $start)
        ->where('se.sname', '=', $end)
        ->whereColumn('rs.sorder', '<', 're.sorder')
        ->select('r.rid')
        ->get();
        return $data;
    } 
}
