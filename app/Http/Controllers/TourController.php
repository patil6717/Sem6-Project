<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\Driver;
use App\Models\tour;
use App\Rules\CheckOtp;
use Illuminate\Support\Facades\Mail;
use App\Models\TourAllocation;
use App\Models\TourBooking;
use Illuminate\Http\Request;
use PDF;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class TourController extends Controller
{
    public function gettour()
    {
        $data=tour::paginate(10);
        foreach ($data as  $value) {
            $data1=TourAllocation::where('tid',$value->tid)->get()->first();
            $seatdata=TourBooking::where('taid',$data1->taid)->get(['gender','seatno']);
            $male=[];
            $female=[];
            foreach ($seatdata as  $value1) {
                if($value1->gender=='male')
                {
                    array_push($male,$value1->seatno);
                }
                else
                {
                    array_push($female,$value1->seatno);
                }
            }
            $value->startdate=$data1->startdate;       
            $value->male=$male;
            $value->female=$female;
        }
       // return $data;
        return view('tour')->with('data',$data);
    }

    public function viewtourbooking($id)
    {
        $tdata=Tour::where('tid',$id)->get()->first();
        $data1=TourAllocation::where('tid',$id)->get()->first();
        $seatdata=TourBooking::where('taid',$data1->taid)->get(['gender','seatno']);
        $male=[];
        $female=[];
        foreach ($seatdata as  $value1) {
            if($value1->gender=='male')
            {
                array_push($male,$value1->seatno);
            }
            else
            {
                array_push($female,$value1->seatno);
            }
        }

        $tdata->male=$male;
        $tdata->female=$female;
        $tdata->startdate=$data1->startdate;
        $tdata->price=$data1->price;
        //return $tdata;
        return view('viewtourbooking')->with('data',$tdata);
    }

    public function gettourform(Request $r)
    {
        $a=explode(',',$r->seatdata);
        $tid=$r->tid;
        return view('viewtourbooking')->with(['seat'=>$a,'tid'=>$r->tid]);
    }
    public function printtourticket(Request $r)
    {
        //return $r->tid;
        $data=Tour::where('tid',$r->tid)->get(['mainattraction','starttime','day','night','price'])->first();
        $data1=TourAllocation::where('tid',$r->tid)->get(['bid','did','startdate'])->first();
        //return $data1;
        $data->startdate=$data1->startdate;
        $bus=Bus::where('bid',$data1->bid)->get('number')->first();
        $driver=Driver::where('did',$data1->did)->get('name')->first();
        $data->bus=$bus->number;
        $data->driver=$driver->name;
        $data->seatno=$r->seatno;
        $data->name=$r->name;
        $data->gender=$r->name;
        $data->age=$r->age;
        $data->phone=$r->phone;
        $data->email=$r->email;
        $data->totalprice=count($r->name)*$data->price;
        //  return $data;
        view()->share('data',$data);
        $pdf = PDF::loadView('tourpdf');
        // session()->flush();
         return $pdf->download('tourpdf.pdf');
      //  return view('tourpdf')->with('data',$data);
    }
    public function savetourbooking(Request $r)
    {
     //   return $r;
        $data=TourAllocation::where('tid',$r->tid)->get('taid')->first();
        for ($i=0; $i < count($r->name); $i++) { 
            $tb=new TourBooking();
            $tb->taid=$data->taid;
            $tb->seatno=$r->seatno[$i];
            $tb->name=$r->name[$i];
            $tb->age=$r->age[$i];
            $tb->gender=$r->gender[$i];
            $tb->phone=$r->phone;
            $tb->email=$r->email;
            $tb->save();
        }
      //  view()->share('data',$binddata);
        return view('viewtourbookingdone')->with('data',$r);
    }
    public function deletetourview(Request $r)
    {
        TourBooking::where('taid',$r->taid)->where('email',$r->email)->where('name',$r->name)->delete();
        $maindata=TourBooking::where('email',$r->email)->get();
        //return $maindata;
        foreach ($maindata as $value) {
           $data=TourAllocation::where('taid',$value->taid)->get()->first();
           $tdata=tour::where('tid',$data->tid)->get()->first();
            $value->main=$tdata->mainattraction;
            $value->startdate=$data->startdate;
            $value->starttime=$tdata->starttime;
            $value->price=$tdata->price;
            $value->day=$tdata->day;
            $bus=Bus::where('bid',$data->bid)->get('number')->first();
            $value->night=$tdata->night;
            $value->number=$bus->number;
        }
        //return $maindata;
        return view('viewtour',['data'=>$maindata]);
   

    }
    public function printtourview(Request $r)
    {
        $tbdata=TourBooking::where('taid',$r->taid)->where('email',$r->email)->where('name',$r->name)->get()->first();
        $tid=TourAllocation::where('taid',$r->taid)->get('tid')->first();
        $data=Tour::where('tid',$tid->tid)->get(['mainattraction','starttime','day','night','price'])->first();
        $data1=TourAllocation::where('tid',$tid->tid)->get(['bid','did','startdate'])->first();
        //return $data1;
        $data->startdate=$data1->startdate;
        $bus=Bus::where('bid',$data1->bid)->get('number')->first();
        $driver=Driver::where('did',$data1->did)->get('name')->first();
        $data->bus=$bus->number;
        $data->driver=$driver->name;
        $data->seatno=$tbdata->seatno;
        $data->name=$tbdata->name;
        $data->gender=$tbdata->gender;
        $data->age=$tbdata->age;
        $data->phone=$tbdata->phone;
        $data->email=$tbdata->email;
        $data->totalprice=$data->price;
        //  return $data;
        view()->share('data',$data);
        $pdf = PDF::loadView('tourpdf1');
        // session()->flush();
         return $pdf->download('tourpdf1.pdf');
      

    }
    public function otpviewbookingtour(Request $r)
    {
      //  return $r->email;
        $to_email=$r->email;
        $otp=rand(100000,999999);
        session()->put('viewotp',$otp);
        $data1=array('Body'=>"Hello From Om Sai Travels",'msg'=>'Your Otp is:','otp'=>$otp);
        Mail::send('otpmail', $data1, function ($message) use ($to_email) {
            $message->from(env('MAIL_USERNAME'),'ViewBookingOtp'); 
            $message->to($to_email)->subject('OTP for Om Sai Travel');
         });
         session()->put('viewemail',$to_email);
         return redirect()->back()->withInput();
    }

    public function viewtour(Request $r)
    {
        $validate=$r->validate([
            'otp'=>['required',new CheckOtp],
        ]);
        $email=Session()->get('viewemail');
        $maindata=TourBooking::where('email',$email)->get();
        //return $maindata;
        foreach ($maindata as $value) {
           $data=TourAllocation::where('taid',$value->taid)->get()->first();
           $tdata=tour::where('tid',$data->tid)->get()->first();
            $value->main=$tdata->mainattraction;
            $value->startdate=$data->startdate;
            $value->starttime=$tdata->starttime;
            $value->price=$tdata->price;
            $value->day=$tdata->day;
            $bus=Bus::where('bid',$data->bid)->get('number')->first();
            $value->night=$tdata->night;
            $value->number=$bus->number;
        }
        //return $maindata;
        return view('viewtour',['data'=>$maindata]);
    }
}
