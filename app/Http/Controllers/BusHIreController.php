<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Station;
use App\Models\Bus;
use App\Models\BusHireBookings;
use App\Models\BusHireRequest;
use App\Models\Driver;
use App\Rules\CheckDate;
use App\Rules\CheckOtp;
use App\Rules\CheckStation;
use App\Rules\lowerDate;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class BusHIreController extends Controller
{
    public function getbushire()
    {
        $stationname = Station::get('sname');
        $stations=[];
        foreach ($stationname as  $value) {
            array_push($stations,$value->sname);
        }
        session()->put('stationsname',$stations);
        return view('bushire',['stations' => $stations]);
    }
    public function requestbus(Request $r)
    {
        //return $r->ac;
        $r->session()->put('startdate',$r->startdate);
        $v=$r->validate([
            'fname'=>['required','alpha'],
            'lname'=>['required','alpha'],
            'phone'=>['required','digits:10'],
            'email'=>['required','email'],
            'from'=>['required', new CheckStation],
            'to'=>['required', new CheckStation],
            'startdate'=>['required',new CheckDate,new lowerDate],
            'starttime'=>'required',
            'enddate'=>['required',new CheckDate,new lowerDate],
            'endtime'=>'required',
            'buscount'=>'required',
            'size'=>'required',
            'wifi'=>'required',
            'ac'=>'required',
        ]);
        $ac =$r->ac=='true'?1:0;
        $wifi= $r->wifi == 'true'?1:0;
        foreach ($r->size as $value) {
            $data= Bus::where('capacity',$value)->where('isAc',$ac)->where('isWifi',$wifi)->where('isAvailable','1')->get();
            if($data->isEmpty())
            {
                return redirect()->back()->withInput()->with('err','Bus Is Not Available For Your Choice Do Changes in Your Selection');
            }
        }
      //  return "something";
        $br=new BusHireRequest();
        $br->fname=$r->fname;
        $br->lname=$r->lname;
        $br->phone=$r->phone;
        $br->email=$r->email;
        $br->from=$r->from;
        $br->to=$r->to;
        $br->startdate=$r->startdate;
        $br->starttime=$r->starttime;
        $br->enddate=$r->enddate;
        $br->endtime=$r->endtime;
        $br->buscount=$r->buscount;
        $br->size=implode(",",$r->size);
        $br->isWifi=$r->wifi=='true'?1:0;
        $br->isAc=$r->ac=='true'?1:0;
        $br->return=$r->return=='true'?1:0;
        $br->isAccepted=false;
        $br->save();
        return redirect()->back()->with('success','Your Request Has Been Sent To The Site, You Will Get Confirmation Shortly');
    }

    public function otpbushirebooking(Request $r)
    {
        $to_email=$r->email;
        $otp=rand(100000,999999);
        session()->put('viewotp',$otp);
        $data1=array('Body'=>"Hello From Om Sai Travels",'msg'=>'Your Otp is:','otp'=>$otp);
        Mail::send('otpmail', $data1, function ($message) use ($to_email) {
            $message->from(env('MAIL_USERNAME'),'ViewBookingOtp'); 
            $message->to($to_email)->subject('OTP for Om Sai Travel');
         });
         session()->put('viewbushireemail',$to_email);
         return redirect()->back()->withInput();
    }  
    function viewbushire(Request $r)
    {
        $validate=$r->validate([
            'otp'=>['required',new CheckOtp],
        ]);
        $email=session()->get('viewbushireemail');
        $todayDate = Carbon::now()->format('Y-m-d');
        $adata=BusHireRequest::where('email',$email)->where('isAccepted',1)->where('startdate','>',$todayDate)->get();

        foreach ($adata as  $value) {
            $data=BusHireBookings::where('bhbrid',$value->bhrid)->get(['totalkm','totalprice'])->first();
            $value->km=$data['totalkm'];
            $value->price=$data['totalprice'];
        }
        $rdata=BusHireRequest::where('email',$email)->where('isAccepted',0)->get();
        // return $rdata;
        return view('viewbushire')->with(['adata'=>$adata,'rdata'=>$rdata]); 
    }
    function printbushire(Request $r)
    {
        $requestdata=BusHireRequest::where('bhrid',$r->id)->get()->first();
        $data=BusHireBookings::where('bhbrid',$r->id)->get();
        foreach ($data as  $value) {
            $bus=Bus::where('bid',$value->bid)->get('number')->first();
            $driver=Driver::where('did',$value->did)->get(['name','phone'])->first();
            $value->number=$bus['number'];
            $value->drivername=$driver['name'];
            $value->driverphone=$driver['phone'];
        }
        $mdata=[];
        array_push($mdata,$data);
        array_push($mdata,$requestdata);     
        view()->share('yo',$mdata);
        $pdf1 = PDF::loadView('bushirepdf');
        return $pdf1->download('bushirepdf.pdf');
    }
    function deletebushire(Request $r)
    {
        BusHireRequest::where('bhrid',$r->id)->where('email',$r->email);
        return redirect()->route('otpbushirebooking');
    }
}
