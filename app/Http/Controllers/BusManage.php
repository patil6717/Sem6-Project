<?php

namespace App\Http\Controllers;
use App\Rules\checknumber;
use App\Models\Bus;
use App\Models\Busallocation;
use App\Models\BusHireBookings;
use App\Models\BusHireRequest;
use App\Models\BusMaintanance;
use Illuminate\Http\Request;

class BusManage extends Controller
{
    public function getBuses()
    {
        $stationdata= Bus::get('number');
        $stations=[];
        foreach ($stationdata as  $value) {
            array_push($stations,$value->number);
        }
        session()->put('busnumber',$stations);
        $data= Bus::paginate(15);
        return view('admin.bus.allbus')->with('data',$data);
    }
    public function saveBus(Request $r)
    {
        $validate=$r->validate([
            'number'=>[new checknumber],
        ]);
        $bid=Bus::max('bid');
       // return $bid;
       // return $r;  
        $d=new Bus();
        $d->bid=$bid+1;
        $d->number=$r->number;
        $d->capacity=$r->capacity; 
        $d->isWifi=$r->wifi;
        $d->isAc=$r->ac;
        if($r->capacity == 30 || $r->capacity == 36)
        {
            $d->isSleeper=1;
        }else
        {
            $d->isSleeper=0;
        }
     //   $d->isSleeper=$r->sleeper;
        $d->isAvailable=1;
        $d->save();
        session()->flash('success','Bus Added');
        return redirect()->back();
    }
    public function deletebus(Request $r)
    {
        //return $r;
        Busallocation::where('bid',$r->id)->update(['bid'=>0]);
        $data=BusHireBookings::where('bid',$r->id)->get(['bhbid','bhbrid']);
        if(!$data->isEmpty())
        {
            BusHireBookings::where('bhbid',$data[0]->bhbid)->delete();
            foreach ($data as  $value) {
                BusHireRequest::where('bhrid',$value->bhbrid)->update(['isAccepted' => 0]);
            }
        }

        Bus::where('bid',$r->id)->delete();
        session()->flash('delete','Bus Data Deleted Successfully');
        return redirect()->back();
    }
    public function editbus(Request $r)
    {
        //return $r;
        Bus::where('did',$r->id)->update([
            'address'=>$r->city,
            'phone'=>$r->mobileno,
            'email'=>$r->email
        ]);
        session()->flash('success','Driver Data Updated');
        return redirect()->back();
    }

    public function getBusmaintain()
    {
        $bus=Bus::get('number');
        $busdata=BusMaintanance::paginate(10);
        foreach ($busdata as $value) {
            $bid=Bus::where('bid',$value->bid)->get('number')->first();
            $value->number=$bid->number;
        }
        // return $busdata;
        return view('admin.bus.busmaintain')->with(['data'=>$busdata,'bus'=>$bus]);
    }
    public function savebusmaintain(Request $r)
    {
        $bus=Bus::where('number',$r->number)->get('bid')->first();
        $busdata=Busallocation::where('bid',$bus->bid)->whereBetween('startdate', [$r->from, $r->to])->get('bid')->first();
        //return $busdata;
        if(!empty($busdata))   
        {           
                Busallocation::where('bid',$busdata->bid)->update([
                    'bid'=>null,
                ]);
            }
        $bm=new BusMaintanance();
        $bm->bid=$bus->bid;
        $bm->fromdate=$r->from;
        $bm->todate=$r->to;
        $bm->description=$r->desc;
        $bm->save();
        session()->flash('success','Bus Is Added To Maintanance');
        return redirect()->back();
    }
    public function deletebusmaintain(Request $r)
    {
        //return $r;
        BusMaintanance::where('bid',$r->id)->delete();
        session()->flash('delete','Bus Is Delete From Maintanance');
        return redirect()->back();
    }
    //
}
