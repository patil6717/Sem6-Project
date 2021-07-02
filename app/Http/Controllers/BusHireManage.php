<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\BusHireBookings;
use App\Models\Station;
use Illuminate\Http\Request;
use App\Models\BusHireRequest;
use App\Models\Driver;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class BusHireManage extends Controller
{
    public function getbushire()
    {
        $requesteddata = BusHireRequest::where('isAccepted',false)->get();
        foreach ($requesteddata as $value) {
            $value->size=explode(',',$value->size);
        }
                //return $requesteddata;
        $accepteddata= BusHireRequest::where('isAccepted',true)->get();
        foreach ($accepteddata as $value) {
            $value->size=explode(',',$value->size);
        }
        if($requesteddata->isEmpty())
        {
           // return view('admin.bushire.bushiremanage',array('rdata'=>$requesteddata,'adata'=>$accepteddata))->with('rdatanot','No Request is There');
           session()->flash('rdatanot','No Request is There');
        }
        if($accepteddata->isEmpty())
        {
            ///return view('admin.bushire.bushiremanage',array('rdata'=>$requesteddata,'adata'=>$accepteddata))->with('adatanot','No Accepted Data Found');
            session()->flash('adatanot','No Accepted Data Found');
        }
       // session()->remove('rdatanot');
        //session()->remove('adatanot');
        return view('admin.bushire.bushiremanage',array('rdata'=>$requesteddata,'adata'=>$accepteddata));
        
    }
    public function acceptbus($id)
    {
        $data=BusHireRequest::where('bhrid',$id)->first();
        $from=$data->from;
        $to=$data->to;
        //return $to;
        $distance=$this->calDistance($from,$to);
        //return $distance;
        $data->size=explode(',',$data->size);
        $ac=$data->isAc;
        $wifi=$data->isWifi;
        $busdata=[];
        $available=1;
        $p=60;
        $price=[];
        foreach ($data->size as $value) {
            if($value==30)
            {
                $p=50;
            }
            else if($value==36)
            {
                $p=60;
            }
            else if($value==40)
            {
                $p=45;
            }
            else if($value==50)
            {
                $p=55;
            }
            array_push($price,$p);
            array_push($busdata,Bus::where('capacity',$value)->where('isAc',$ac)->where('isWifi',$wifi)->where('isAvailable',$available)->get());
        }
        $additionalprice=0;
        if($data->isAc==1)
        {
            $additionalprice+=5;
        }
        if($data->isWifi==1)
        {
            $additionalprice+=5;
        }
        $totalprice=0;
        foreach ($price as  $value) {
            $totalprice+=$value;
        }
        $avgprice=$totalprice/count($price);
        $tprice=$avgprice+$additionalprice;
        $perdaycharge=$tprice*$distance;
        $start=Carbon::createFromDate($data->startdate);
        $end=Carbon::createFromDate($data->enddate);
        $day=$start->diffInDays($end);
        $finalamount=$day*$perdaycharge;
        $driver=Driver::where('isAvailable','1')->get();
        if($data->return==1)
        {
            $finalamount=(round($finalamount/1000)*1000)*2;
        }
        else
        {
            $finalamount=(round($finalamount/1000)*1000);
        }

        session()->put('distance',$distance);
        session()->put('finalamount',$finalamount);
        return view('admin.bushire.bushireform',array('rdata'=>$data,'busdata'=>$busdata,'driver'=>$driver));
    }
    function calDistance($start,$end)
    {
        $startcoordinate=Station::where('sname','=',$start)->select(array('latitude','longitude'))->first();
        $endcoordinate=Station::where('sname','=',$end)->select(array('latitude','longitude'))->first();
        $curlSession = curl_init();
        curl_setopt($curlSession, CURLOPT_URL, "https://dev.virtualearth.net/REST/v1/Routes/DistanceMatrix?origins=$startcoordinate->latitude,$startcoordinate->longitude&destinations=$endcoordinate->latitude,$endcoordinate->longitude&travelMode=driving&key=AinSZboYsSxYCdeCUTAkARJXVn-4OvVOBMcYoX5nodydVGqFISesKBevGYUe99Vt");
        curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
        $jsonData = json_decode(curl_exec($curlSession));
        $distance= $jsonData->resourceSets[0]->resources[0]->results[0]->travelDistance;
        curl_close($curlSession);  
        return $distance;    
    }
    
    function bookbushire(Request $r)
    {
        //return $r;
        $to_email=$r->email;
        $dest=BusHireRequest::where('bhrid',$r->id)->get(['from','to'])->first();
        BusHireRequest::where('bhrid',$r->id)->update(['isAccepted'=>1]);
        $driver=Driver::whereIn('did',$r->did)->get(['name','phone']);
         $data1=array('Body'=>"Hello From Om Sai Travels",'confirmation'=>'Your Confirmation Is Done:','driver'=>$driver,'bus'=>$r->bid,'total'=>$r->total,'km'=>$r->distance,'dest'=>$dest);
         Mail::send('otpbushire', $data1, function ($message) use ($to_email) {
             $message->from(env('MAIL_USERNAME'),'Confirmation Mail'); 
             $message->to($to_email)->subject('Related Bus Hire Inquire At Om Sai Travels');
          });
          //return "true";
        //return $r;
        $length=count($r->size);
        for($i=0;$i<$length;$i++)
        {
            $bh=new BusHireBookings();
            $bh->bhbrid=$r->id;
            $bh->size=$r->size[$i];
            $id=Bus::Where('number',$r->bid[$i])->get('bid')->first();
            Bus::where('bid',$id->bid)->update(['isAvailable'=>0]);
            Driver::where('did',$r->did)->update(['isAvailable'=>0]);
           // DB::update('update buses set isAvailable = 0 where bid = ?', $id);
            // DB::update('update drivers set isAvailable = 0 where did = ?', $r->did);
            $bh->bid=$id->bid;
            $bh->did=$r->did[$i];
            $bh->totalkm=$r->distance;
            $bh->totalprice=$r->total;
            $bh->save();
        }
      
        BusHireRequest::where('bhrid',$r->id)->update(['isAccepted'=>1]);
        //session()->remove('deleted');
        session()->flash('acceptbushire','Changes Saved');
        return redirect()->route('bushiremanage');
        
    }
    function viewbus($id)
    {
        $requestdata=BusHireRequest::where('bhrid',$id)->get()->first();
        $accepteddata=BusHireBookings::where('bhbrid',$id)->get();
        foreach ($accepteddata as  $value) {
            $number=Bus::where('bid',$value->bid)->get('number')->first();
            $name=Driver::where('did',$value->did)->get('name')->first();
            $value->name=$name->name;
            $value->number=$number->number;
        }
        return view('admin.bushire.viewbushire')->with(['adata'=>$accepteddata,'rdata'=>$requestdata]);
        //return $id;
        // $data=BusHireRequest::where('bhrid',$id)->first();
        // $from=$data->from;
        // $to=$data->to;
        // $distance=$this->calDistance($from,$to);
        // $data->size=explode(',',$data->size);
        // $ac=$data->isAc;
        // $wifi=$data->isWifi;
        // $busdata=[];
        // $available=1;
        // $p=60;
        // $price=[];
        // foreach ($data->size as $value) {
        //     if($value==30)
        //     {
        //         $p=50;
        //     }
        //     else if($value==36)
        //     {
        //         $p=60;
        //     }
        //     else if($value==40)
        //     {
        //         $p=45;
        //     }
        //     else if($value==50)
        //     {
        //         $p=55;
        //     }
        //     array_push($price,$p);
        //     array_push($busdata,Bus::where('capacity',$value)->where('isAc',$ac)->where('isWifi',$wifi)->where('isAvailable',$available)->get());
        // }
        // $additionalprice=0;
        // if($data->isAc==1)
        // {
        //     $additionalprice+=5;
        // }
        // if($data->isWifi==1)
        // {
        //     $additionalprice+=5;
        // }
        // $totalprice=0;
        // foreach ($price as  $value) {
        //     $totalprice+=$value;
        // }
        // $avgprice=$totalprice/count($price);
        // $tprice=$avgprice+$additionalprice;
        // $perdaycharge=$tprice*$distance;
        // $start=Carbon::createFromDate($data->startdate);
        // $end=Carbon::createFromDate($data->enddate);
        // $day=$start->diffInDays($end);
        // $finalamount=$day*$perdaycharge;
        // $driver=Driver::where('isAvailable','1')->get();
        // if($data->return==1)
        // {
        //     $finalamount=(round($finalamount/1000)*1000)*2;
        // }
        // else
        // {
        //     $finalamount=(round($finalamount/1000)*1000);
        // }

        // session()->put('distance',$distance);
        // session()->put('finalamount',$finalamount);
        // return view('admin.bushire.viewbushire',array('rdata'=>$data,'busdata'=>$busdata,'driver'=>$driver));
    }
    function deletebus($id)
    {
        $data=BusHireRequest::where('bhrid',$id)->get('email')->first();
        $to_email=$data->email;
        $dest=BusHireRequest::where('bhrid',$id)->get(['from','to'])->first();
        $data1=array('Body'=>"Hello From Om Sai Travels",'confirmation'=>'Your Request is Cancelled :','dest'=>$dest);
        Mail::send('otpcancelbushire', $data1, function ($message) use ($to_email) {
            $message->from(env('MAIL_USERNAME'),'Rejection Mail'); 
            $message->to($to_email)->subject('Related Bus Hire Inquire At Om Sai Travels');
         });
        //return "true";
        BusHireRequest::Where('bhrid',$id)->delete();
        //session()->remove('acceptbushire');
        session()->flash('deleted','Deleted Successfully');
        return redirect()->route('bushiremanage');
    }
   
}
