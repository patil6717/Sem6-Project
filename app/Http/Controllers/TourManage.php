<?php

namespace App\Http\Controllers;
use App\Models\Bus;
use App\Models\Busallocation;
use App\Models\Driver;
use App\Models\hotel;
use App\Models\Station;
use App\Models\tour;
use App\Models\TourAllocation;
use Illuminate\Http\Request;

class TourManage extends Controller
{
    public function gettour()
    {
        $data=TourAllocation::paginate(15);
        foreach ($data as $value) {
            $data1=tour::where('tid',$value->tid)->get()->first();
            $value->main=$data1->mainattraction;
            $value->day=$data1->day;
            $value->night=$data1->night;
            $value->price=$data1->price;
            $station=Station::where('sid',$data1->startlocation)->get('sname')->first();
            $value->station=$station->sname;
            $value->starttime=$data1->starttime;
            $value->image=$data1->image;
            $bus=Bus::where('bid',$value->bid)->get('number')->first();
            $driver=Driver::where('did',$value->did)->get('name')->first();
            $value->bus=$bus->number;
            $value->driver=$driver->name;
        }
       // return $data;
        return view("admin.tour.gettour")->with('data',$data);
    }
   
    public function viewaddtour(Request $r)
    {
        //return "hello";
        $hotel=Hotel::get();
        $busdata=Busallocation::groupby('bid')->get('bid');
        $arrbus=[];
        foreach ($busdata as  $value) {
            if($value->bid!=null)
            array_push($arrbus,$value->bid);
        }
        $driverdata=Busallocation::groupby('did')->get('did');
        $arrdriver=[];
        foreach ($driverdata as  $value) {
            if($value->did!=null)
            array_push($arrdriver,$value->did);
        }
       // return $arrbus;
        $bus=Bus::where('isAvailable',1)->wherenotin('bid',$arrbus)->get();
        $driver=Driver::where('isAvailable',1)->wherenotin('did',$arrdriver)->get();
        $station=Station::get();
        return view("admin.tour.addtour")->with(['hotel'=>$hotel,'bus'=>$bus,'driver'=>$driver,'station'=>$station]);
    }
    public function savetour(Request $r)
    {
        //return $r;
        $fileextension = $r->file('image')->getClientOriginalExtension();
        $filename = $r->main.time().$fileextension;
            if (!$r->file('image')->storeAs('public/tour/', $filename))
            {
                session()->flash('error','Your profile Picture can not uploded');
                return redirect()->back();
            }
          
                $t=new tour();
                $t->mainattraction=$r->main;
                $t->day=$r->day;
                $t->night=$r->night;
                $t->price=$r->price;
                $t->startlocation=$r->city;
                $t->pickuplocation=$r->pickup;
                $t->starttime=$r->starttime;
                $t->image=$filename;
                $t->save();        
                $t1=$r->bus;
                $tid=Tour::where('mainattraction',$r->main)->where('starttime',$r->starttime)->get('tid')->first();
                $ta=new TourAllocation();
                $ta->tid=$tid->tid;
                $ta->bid = $r->bus;
                $ta->did = $r->driver;
                $ta->startdate=$r->startdate;
                $ta->save();

                session()->flash('success','Your Tour Added');
                return redirect()->route('admin.tourmanage');
                
    }
    public function gethotel()
    {
        $data=hotel::paginate(5); 
        $staion=Station::get(['sid','sname']);  
        foreach ($data as $value) {
            $sname=Station::where('sid',$value->sid)->get('sname')->first();
            $value->sname=$sname->sname;
        }
        return view('admin.tour.gethotel')->with(["data"=>$data,'station'=>$staion]);
    }
    public function deletehotel(Request $r)
    {
       // return $r;
        TourAllocation::where('hid',$r->id)->update([
            'hid'=>null,
        ]);
        Hotel::where('hid',$r->id)->delete();
        session()->flash('deleted'," Hotel Deleted");
        return redirect()->back();
    }
    public function deletetour(request $r)
    {
        TourAllocation::where('tid',$r->id)->delete();
        tour::where('tid',$r->id)->delete();
        session()->flash('deleted'," Tour Deleted");
        return redirect()->back();
    }
    
    public function savehotel(Request $r)
    {
        //return $r;
        $h=new hotel();
        $h->hname=$r->name;
        $h->sid=$r->city;
        $h->save();
        session()->flash('success',"Successfully Added Hotel");
        return redirect()->back();
        //return $r;
    }
}
