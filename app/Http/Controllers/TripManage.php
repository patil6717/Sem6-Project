<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use DatePeriod;
use DateInterval;
use App\Models\Busallocation;
use App\Models\Driver;
use App\Models\Route;
use App\Models\Routemap;
use App\Models\Station;
use App\Models\Shedule;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Kyslik\ColumnSortable\Sortable;

class TripManage extends Controller
{
    function deleteroute($rid)
    {
        $shid=Shedule::where('rid',$rid)->get('shid');
        $shidarray=[];
        foreach ($shid as $sh) {
            array_push($shidarray,$sh->shid);
        }
        Busallocation::whereIn('shid',$shidarray)->delete();
        Shedule::where('rid',$rid)->delete();
        Routemap::where('rid',$rid)->delete();
        Route::where('rid',$rid)->delete();
        session()->flash('deletesuccess','Route Deleted Successfully');
        return redirect()->route('admin.routes');
        //return $shidarray;
        //return $shid;
    }
    public function viewroute($r)
    {
        $saveroute=session()->get('saveroute');
        $routedata=Route::where('rid',$r)->get()->first();
        $routemapdata=Routemap::where('rid',$r)->get();
        $sheduledata=Shedule::where('rid',$r)->get();
        foreach ($routemapdata as  $value) {
            $sname=Station::where('sid',$value->sid)->get('sname')->first();
            $value->sname=$sname->sname;
        }
        return view('admin.trip.viewroute',['route'=>$routedata,'map'=>$routemapdata,'shedule'=>$sheduledata]);
      //  return $routemapdata;
    }
  
    public function saveroutedata(Request $req)
    {
        $r=new Route();
         $r->from_st=$req->from;
         $r->to_st=$req->to;
         $r->via=implode(',',$req->sname);
         $r->save();
        $rid=Route::where('from_st',$req->from)->where('to_st',$req->to)->where('via',implode(',',$req->sname))->get('rid')->first();
        //return $rid;
        $tfromp=0;
        for($i=0;$i<count($req->sname);$i++)
        {
            $rm=new Routemap();
            $rm->rid=$rid->rid;
            $sid=Station::where('sname',$req->sname[$i])->get('sid')->first();
            $rm->sid=$sid->sid;
            $rm->sorder=$req->sorder[$i];
            $tfromp+=$req->tfromp[$i];
            $rm->tfromp=$tfromp;
            $rm->delay=$req->delay[$i];
            $rm->save();
        }
        for ($i=0; $i < count($req->shedules) ; $i++) { 
            $sh=new Shedule();
            $sh->rid=$rid->rid;
            $sh->starttime=$req->shedules[$i];
            $sh->save();
        }  
       session()->flash('saveroute','Your Route,Shedules Is Saved');
       return redirect()->route('admin.routes');
    
    }
    public function saverouteedit(Request $re)
    {
        $id=$re->rid;
        $via=implode(",",$re->sname);
         Route::where('rid',$re->rid)->update(['via'=>$via]);
        Routemap::where('rid',$re->rid)->delete();
        $count=0;
        $t=0;
        for($i=0;$i<count($re->sname);$i++)
        {
            $rm=new Routemap();
            $count++;
            $rm->rid=$id;
            $sid= Station::where('sname',$re->sname[$i])->get('sid')->first();
            $rm->sid=$sid->sid;
            $rm->sorder=$count;
            $t+=$re->tfromp[$i];
           $rm->tfromp=$t;
           $rm->delay=$re->delay[$i];
           $rm->save();
        }
        session()->flash('saveroute','Your Changes Are Saved');
        return redirect()->route('viewroute',$id);
    }   
    public function saverouteshedule(Request $r)
    {
        //return $r; 
        //  Shedule::where('rid',$r->rid)->delete();
        $id=$r->rid;
        $end=Route::where('rid',$r->rid)->get('to_st')->first();
        $endid=Station::where('sname',$end->to_st)->get('sid')->first();
        $sheduledata=Shedule::where('rid',$r->rid)->get();
        $tfromp=Routemap::where('rid',$r->rid)->where('sid',$endid->sid)->get('tfromp')->first();
        //return $tfromp;
        $delay=Routemap::where('rid',$r->rid)->get('delay');
        $total=0;
        foreach ($delay as $value) {
            $total+=$value->delay;
        }
        
        for ($i=0; $i < count($r->shedule) ; $i++) {
            $j=0;
                foreach ($sheduledata as  $value) {
                    if($value->starttime == $r->shedule[$i])
                    {
                            $j=1;
                    }
                }
                    if($j==0)
                    {
                        $sh =new Shedule();
                        $sh->rid=$r->rid;
                        $sh->starttime=$r->shedule[$i];
                        $time=new DateTime($r->shedule[$i]);
                        $stime=$time->add(new DateInterval('PT' . $tfromp->tfromp . 'M'));
                        $stime=$stime->add(new DateInterval('PT' . $total . 'M'));
                        $sh->endtime=$stime->format('H:i:s');
                        $sh->save();
                    }
                 
              
            
        }
         
        session()->flash('saveroute','Your Shedules Are Updated');
        return redirect()->route('viewroute',$id);   
    }
    public function getTrip()
    {
        return view('admin.trip.tripmanage');
    }
    public function getRoutes(Request $request)
    {
        $saveroutes= session()->get('saveroutes');
        $deletesuccess= session()->get('deletesuccess');
        $filter = $request->query('filter1');
        $filter2 = $request->query('filter2');

        if (empty($filter) && empty($filter2)) {
            $route=Route::sortable()->paginate(5);
          } else {
            if(!empty($filter) && !empty($filter2) )
            {
                $route=Route::where('from_st', 'like', '%'.$filter.'%')->where('to_st', 'like', '%'.$filter2.'%')->sortable()->paginate(5);
            }
            else
            {
                if(empty($filter))
                {
                    $route=Route::where('to_st', 'like', '%'.$filter2.'%')->paginate(5);
    
                }
                else
                {
                    $route=Route::where('from_st', 'like', '%'.$filter.'%')->paginate(5);
                }
            }
                    $route->appends($request->all());
      
        }
    

      
        $station=Station::get('sname');
        return view('admin.trip.routes',['routes'=>$route,'stations'=>$station])->with(['filter1'=>$filter,'filter2'=>$filter2]);
    }
    public function getShedules(Request $request)
    {   
        $saveroute=session()->get('saveroute');
        $filter = $request->query('filter1');
        $filter2 = $request->query('filter2');

        if (empty($filter) && empty($filter2)) {
            $routedata=Route::paginate(5);
        } else {
            if(!empty($filter) && !empty($filter2) )
            {
                $routedata=Route::where('from_st', 'like', '%'.$filter.'%')->where('to_st', 'like', '%'.$filter2.'%')->paginate(5);
            }
            else
            {
                if(empty($filter))
                {
                    $routedata=Route::where('to_st', 'like', '%'.$filter2.'%')->paginate(5);
    
                }
                else
                {
                    $routedata=Route::where('from_st', 'like', '%'.$filter.'%')->paginate(5);
                }
            }
                    $routedata->appends($request->all());
      
        }
    
        foreach ($routedata as  $value) {
            $shedule=Shedule::where('rid',$value->rid)->get();
            $value->shedule=$shedule;
        }
        //return $routedata;

       
        return view('admin.trip.shedules',['datas'=>$routedata])->with(['filter1'=>$filter,'filter2'=>$filter2]);
    }
    public function getAllocations(Request $r)
    {
        $message=session()->get('success');
        $date=$r->date;
        //return $date;
        //$date1 = new DateTime($r->date);
       // $date2= $date1->modify('+1 day');
       // return $date1;
        if(empty($r->date))
        {
            $date=Carbon::now()->format('Y-m-d');
            $date1=Carbon::now()->add(1,'day')->format('Y-m-d');
            session()->put('today',$date);
            session()->put('tomorrow',$date1);
            $todayroute=Route::paginate(5);
                foreach ($todayroute as  $value) {
                    $todayshedule=Shedule::where('rid',$value->rid)->get();
                    foreach ($todayshedule as  $value1) {
                        $baid=Busallocation::where('shid',$value1->shid)->where('rid',$value->rid)->where('startdate',$date)->get()->first();
                        if(empty($baid))
                {
                    $value1->busallocation=$baid;
                }
                else
                {
                    $value1->driver=Driver::where('did',$baid->did)->get('name')->first();
                    $value1->bus=Bus::where('bid',$baid->bid)->get('number')->first();
                    $value1->busallocation=$baid;
                }
                    }
                    $value->shedule=$todayshedule;
                }

                 $tommorowroute=Route::paginate(5);
                foreach ($tommorowroute as  $value) {
                    $tomorrowshedule=Shedule::where('rid',$value->rid)->get();
                    foreach ($tomorrowshedule as  $value1) {
                        $baid=Busallocation::where('shid',$value1->shid)->where('rid',$value->rid)->where('startdate',$date1)->get()->first();
                        //return $date1;
                        if(empty($baid))
                        {
                            $value1->busallocation=$baid;
                        }
                        else
                        {
                            $value1->driver=Driver::where('did',$baid->did)->get('name')->first();
                            $value1->bus=Bus::where('bid',$baid->bid)->get('number')->first();
                            $value1->busallocation=$baid;
                        }
                    }
                    $value->shedule=$tomorrowshedule;
            }
            //return $tommorowroute;
            return view('admin.trip.allocations')->with(['todaydata'=>$todayroute,'tomorrowdata'=>$tommorowroute]);
         }      
        else
        {
            $date=$r->date;
            $date1 =date('Y-m-d', strtotime("+1 day", strtotime($r->date)));
            
            session()->put('today',$date);
            session()->put('tomorrow',$date1);
            //return $date1;
            $todayroute=Route::paginate(5);
            foreach ($todayroute as  $value) {
            $todayshedule=Shedule::where('rid',$value->rid)->get();
            foreach ($todayshedule as  $value1) {
                $baid=Busallocation::where('shid',$value1->shid)->where('rid',$value->rid)->where('startdate',$r->date)->get()->first();
                if(empty($baid))
                {
                    $value1->busallocation=$baid;
                }
                else
                {
                    $value1->driver=Driver::where('did',$baid->did)->get('name')->first();
                    $value1->bus=Bus::where('bid',$baid->bid)->get('number')->first();
                    $value1->busallocation=$baid;
                }
               
            }
            $value->shedule=$todayshedule;
            }   
            $tommorowroute=Route::paginate(5);
            foreach ($tommorowroute as  $value) {
            $tomorrowshedule=Shedule::where('rid',$value->rid)->get();
            foreach ($tomorrowshedule as  $value1) {
                $baid=Busallocation::where('shid',$value1->shid)->where('rid',$value->rid)->where('startdate',$date1)->get()->first();
                if(empty($baid))
                {
                    $value1->busallocation=$baid;
                }
                else
                {
                    $value1->driver=Driver::where('did',$baid->did)->get('name')->first();
                    $value1->bus=Bus::where('bid',$baid->bid)->get('number')->first();
                    $value1->busallocation=$baid;
                }
            }
            $value->shedule=$tomorrowshedule;
            }
            //return $todayroute;
            return view('admin.trip.allocations')->with(['todaydata'=>$todayroute,'tomorrowdata'=>$tommorowroute]);

        }
        $route=Route::get();
        foreach ($route as  $value) {
            $shedule=Shedule::where('rid',$value->rid)->get();
            foreach ($shedule as  $value1) {
                $baid=Busallocation::where('shid',$value1->shid)->where('rid',$value->rid)->get();
            
                $value1->busallocation=$baid;
            }
            $value->shedule=$shedule;
        }
        return view('admin.trip.allocations')->with(['data'=>$route]);
}
public function copydata($date)
{
    $arr=explode('-',$date);
    $dt=Carbon::create($arr[0],$arr[1],$arr[2],0);
    $datadate= $dt->subday(2)->format('Y-m-d');
    $aheaddate=$dt->addday(3)->format('Y-m-d');
    $allocationData=Busallocation::where('startdate',$datadate)->get();
    //return $allocationData;
    foreach ($allocationData as  $value) {
        $ba= new Busallocation();
        $ba->shid=$value->shid;
        $ba->rid=$value->rid;
        $ba->did=$value->did;
        $ba->bid=$value->bid;
        $ba->startdate=$date;
        if($value->startdate!=$value->enddate)
        {
            $ba->enddate=$aheaddate;
        }else
        {
            $ba->enddate=$aheaddate;
        }
        $ba->isOver=0;
        $ba->save();
    }
    return redirect()->back();
}
public function deleteshedule($id)
{
   // return $id;
    Shedule::where('shid',$id)->Delete();
    return redirect()->back();
}
    public function viewallocate(Request $r)
    {
        //return $r;
        //return $r;
        $biddata=Busallocation::where('startdate',$r->date)->get('bid');
        $array=[];
        if(count($biddata)>0)
        {
            foreach ($biddata as  $value) {
                if($value->bid!=null)
                array_push($array,$value->bid);
            }
            $busdata=Bus::whereNotIn('bid',$array)->where('isAvailable',1)->get(['bid','number']);
        }
        else
        {
            $busdata=Bus::where('isAvailable',1)->get(['bid','number']);      
        }
        $diddata=Busallocation::where('startdate',$r->date)->groupby('did')->get('did');
       // return $diddata;
        $arr=[];
        if(count($diddata)>0)
        {
            foreach ($diddata as  $value) {
                if($value->did!=null)
                array_push($arr,$value->did);
            }
            $driverdata=Driver::whereNotIn('did',$arr)->where('isAvailable',1)->get(['did','name']);
        //   /  return $driverdata;
        }
        else
        {
            $driverdata=Driver::where('isAvailable',1)->get(['did','name']);    
        }
        
        if($r->starttime>$r->endtime)
        {
            $enddate= date('Y-m-d', strtotime("+1 day", strtotime($r->date)));
        }
        else
        {
            $enddate=$r->date;
        }
         $busid=Busallocation::where('rid',$r->rid)->where('shid',$r->shid)->where('startdate',$r->date)->get('bid')->first();
         $did=Busallocation::where('rid',$r->rid)->where('shid',$r->shid)->where('startdate',$r->date)->get('did')->first();
          
         if(!empty($did->did))
            {
                $driver=Driver::where('did',$did->did)->get('name')->first();
               session()->put('did',$did->did);
               session()->put('dname',$driver->name);
            }
            if(!empty($busid->bid))
            {
                $bus=Bus::where('bid',$busid->bid)->get('number')->first();
                session()->put('bid',$busid->bid);;
                session()->put('bnumber',$bus->number);;
            }
            return view('admin.trip.allocateroute')->with(['rid'=>$r->rid,'date'=>$r->date,'enddate'=>$enddate,'rid'=>$r->rid,'bus'=>$busdata,'driver'=>$driverdata,'starttime'=>$r->starttime,'endtime'=>$r->endtime]);
    }
    public function addroute()
    {
        $station= Station::get('sname');
        return view('admin.trip.addroute',['stations'=>$station]);
    }
    public function vieweditroutemap($r)
    {
        $stationname=Station::get('sname');
        $mapdata=Routemap::where('rid',$r)->get();
        $mapdata[0]->time=0;
        for ($i=1; $i < count($mapdata); $i++) { 
            $mapdata[$i]->time=$mapdata[$i]->tfromp-$mapdata[$i-1]->tfromp;
        }
       // return $mapdata;
     
        // /return count($mapdata);
        foreach ($mapdata as $value) {
            $sname=Station::where('sid',$value->sid)->get('sname')->first();
            $value->sname=$sname->sname;
            if($value->sorder==count($mapdata))
            {  
                session()->put('enddata',$value);
              //return $value->sname;
            }
        }
       // session()->put();
        return view('admin.trip.editroutemap',['station'=>$stationname,'map'=>$mapdata]);
    }
    function viewridshedule($r)
    {
        $sheduledata=Shedule::where('rid',$r)->get();
        return view('admin.trip.editrouteshedule1',['shedule'=>$sheduledata]);
    }
    function vieweditrouteshedule($r)
    {
        $sheduledata=Shedule::where('rid',$r)->get();
        return view('admin.trip.editrouteshedule',['shedule'=>$sheduledata]);
    }
    function saveridshedule(Request $r)
    {
       
       $sheduledata=Shedule::where('rid',$r->rid)->get();
        $id=$r->rid;
        $end=Route::where('rid',$r->rid)->get('to_st')->first();
        $endid=Station::where('sname',$end->to_st)->get('sid')->first();
        $tfromp=Routemap::where('rid',$r->rid)->where('sid',$endid->sid)->get('tfromp')->first();
        $delay=Routemap::where('rid',$r->rid)->get('delay');
        $total=0;
        foreach ($delay as $value) {
            $total+=$value->delay;
        }
        
        for ($i=0; $i < count($r->shedule) ; $i++) {
            $j=0;
                foreach ($sheduledata as  $value) {
                    if($value->starttime == $r->shedule[$i])
                    {
                            $j=1;
                    }
                }
                    if($j==0)
                    {
                        $sh =new Shedule();
                        $sh->rid=$r->rid;
                        $sh->starttime=$r->shedule[$i];
                        $time=new DateTime($r->shedule[$i]);
                        $stime=$time->add(new DateInterval('PT' . $tfromp->tfromp . 'M'));
                        $stime=$stime->add(new DateInterval('PT' . $total . 'M'));
                        $sh->endtime=$stime->format('H:i:s');
                        $sh->save();
                    }   
        }

        Session()->flash('saveroute', 'Your Changes Are Saved');
        return redirect()->route('admin.shedules',$id);
       // return view('admin.trip.shedules',['datas'=>$routedata])->with('saveroute','Your Changes Are Saved'); 
    }
    public function saveallocation(Request $r)
    {
       // return $r;
        $shid=Shedule::where('starttime',$r->starttime)->where('rid',$r->rid)->get('shid')->first();
        if(session()->has('bid') || session()->has('did'))
        {
            if($r->bid == session()->get('bid'))
            {
                Busallocation::where('bid',$r->bid)->where('startdate',$r->startdate)->update([
                    'did' => $r->did,
                ]);
                session()->remove('bid');
            }
            if($r->did == session()->get('did'))
            {
                Busallocation::where('did',$r->did)->where('startdate',$r->startdate)->update([
                    'bid' => $r->bid,
                ]);
       
            }
            session()->remove('did');
        }
        else
        {
            //return "hellp";
            $ba= new Busallocation();
            $ba->shid=$shid->shid;
            $ba->rid=$r->rid;
            $ba->startdate=$r->startdate;
            $ba->enddate=$r->enddate;
            $ba->bid=$r->bid;
            $ba->did=$r->did;
            $ba->isOver=0;
            $ba->save();
        
        }
        session()->flash('success','Your Changes Are Saved');
        return redirect()->route('admin.allocation');
    }


    public function getstation()
    {
        $data=Station::paginate(10);
        return view('admin.station')->with('data',$data);
    }

    public function savestation(Request $r)
    {
      //  return $r;
      $s= new Station();
      $s->sname=$r->name;
      $s->location=$r->location;
      $s->latitude=$r->lat;
      $s->longitude=$r->long;
      $s->Save();
      session()->flash('success','Station Added');
      return redirect()->back();
    }
    public function editstation(Request $r)
    {
        Station::where('sid',$r->id)->update([
            'latitude'=>$r->lat,
            'longitude'=>$r->long,
            'location'=>$r->location
        ]);
        session()->flash('success','Changes Saved');
        return redirect()->back();
    }
    public function deletestation(Request $r)
    {
     
       $data=Routemap::where('sid',$r->id)->get();
       if($data->isEmpty())
       {
        Station::where('sid',$r->id)->delete();
        session()->flash('deleted','Station Deleted');
        return redirect()->back();
       }
       else
       {
        session()->flash('deleted','Cant Delete Station Because Is there In Route');
        return redirect()->back();
       }
    }
}
