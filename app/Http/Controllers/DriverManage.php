<?php

namespace App\Http\Controllers;

use App\Models\Busallocation;
use App\Models\BusHireBookings;
use App\Models\BusHireRequest;
use App\Models\Driver;
use Illuminate\Http\Request;

class DriverManage extends Controller
{
    public function getDrivers()
    {
        $data= Driver::paginate(15);
        return view('admin.driver.alldriver')->with('data',$data);
    }
    public function saveDriver(Request $r)
    {
        $d=new Driver();
        $d->name=$r->name;
        $d->address=$r->city;
        $d->phone=$r->mobileno;
        $d->email=$r->email;
        $d->isAvailable=1;
        $d->save();
        session()->flash('success','Driver Added');
        return redirect()->back();
    }
    public function deletedriver(Request $r)
    {
        //return $r;
        Busallocation::where('did',$r->id)->update(['did'=>null]);
        $data=BusHireBookings::where('did',$r->id)->get(['bhbid','bhbrid']);
        if(!$data->isEmpty())
        {
            BusHireBookings::where('bhbid',$data[0]->bhbid)->delete();
            foreach ($data as  $value) {
                BusHireRequest::where('bhrid',$value->bhbrid)->update(['isAccepted' => 0]);
            }
        }
        Driver::where('did',$r->id)->delete();
        session()->flash('delete','Driver Data Deleted Successfully');
        return redirect()->back();
    }
    public function editdriver(Request $r)
    {
        //return $r;
        Driver::where('did',$r->id)->update([
            'address'=>$r->city,
            'phone'=>$r->mobileno,
            'email'=>$r->email
        ]);
        session()->flash('success','Driver Data Updated');
        return redirect()->back();
    }
    public function getDriversleave()
    {
        
    }
}
