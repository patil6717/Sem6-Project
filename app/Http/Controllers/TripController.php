<?php

namespace App\Http\Controllers;
use App\Models\Bus;
use App\Models\user;
use App\Models\Busallocation;
use App\Models\Station;
use App\Models\TicketBooking;
use App\Models\userotp;
use App\Rules\CheckOtp;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
// use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Auth\Events\Validated;
use Exception;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Collection;
use PDF;
use function PHPUnit\Framework\isEmpty;

class TripController extends Controller
{
    public $a=[];
    public function gethome()
    {
        $station= Station::get('sname');
        return view('home1',['stations'=>$station]);
    }
    public function BookingForm(Request $r)
    {
       
        $baid=$r->baid;
        $starttime=$r->starttime;
        $endtime=$r->endtime;
        $enddate=$r->enddate;
       
        session()->put('startdate',$r->date);
       
        if(empty($r->seatdata))
        {
            abort('404');
        }
        $startdate=session()->get('date');
        $bid=Busallocation::Where('baid',$baid)->get('bid')->first();
        $number=Bus::Where('bid',$bid->bid)->get('number')->first();
        
        $price=$r->price;
        $seatdata= explode(",",$r->seatdata);
        $o=[];
        $counter=0;
       foreach ($seatdata as $key => $value) {
           $j=(object)$value;
            array_push($o,$j);
            $counter++;
       };
       $r->session()->put('price', $price);
       $r->session()->put('number', $number->number);
       $r->session()->put('baid', $baid);
       $r->session()->put('total', $counter);
       $r->session()->put('starttime',$starttime);
       $r->session()->put('endtime',$endtime);
       $r->session()->put('enddate',$enddate);
       $a=$o;
        return view('TripTicketForm',array('data'=>$o));        
    }
    public function bookticket(Request $r)
    {
        //return $r->email;
        $r->session()->put('email',$r->email);
        $r->session()->put('bookingdata',$r->all());
        $to_name="Hello User";
        $otp=rand(100000,999999);
        $to_email=$r->email;
       // $data=userotp::where('email',$to_email)->get();
       // return empty($data);
       
        $data1=array('Body'=>"Hello From Om Sai Travels",'msg'=>'Your Otp is:','otp'=>$otp);
        Mail::send('otpmail', $data1, function ($message) use ($to_email) {
            $message->from(env('MAIL_USERNAME'),'Om Sai Travels'); 
            $message->to($to_email)->subject('OTP for Om Sai Travel');
         });
         $r->session()->put('registerotp',$otp);
         return redirect()->route('otpconfirmation');
    }
    public function reotp()
    {

        $to_email=session()->get('email');
       // return $to_email;
        $otp=rand(100000,999999);
        session()->put('registerotp',$otp);
        $data1=array('Body'=>"Hello From Om Sai Travels",'msg'=>'Your Otp is:','otp'=>$otp);
        Mail::send('otpmail', $data1, function ($message) use ($to_email) {
            $message->from(env('MAIL_USERNAME'),'Test'); 
            $message->to($to_email)->subject('OTP for Om Sai Travel');
         });
         return view('otpconfirmation');
    }
    public function otpconfirmation()
    {
        return view('otpconfirmation');
    }
    public function confirmtrip(Request $r)
    {
        
        $otp=Session()->get('registerotp');
        if($otp==$r->otp)
        {
            $data=session()->get('bookingdata');
        //    return gettype($data);
            $baid=session()->get('baid');
            $price=session()->get('price');
            $total=(session()->get('price')*session()->get('total'));
            session()->put('totalprice',$total);
            $count=session()->get('total');
            $enddate=session()->get('enddate');
            //$seat=$data->seat;
          //  return gettype($seat);
            $phone=$data['phone'];
            session()->put('phone',$phone);
            $email=$data['email'];
            session()->put('email',$email);
            $time = Carbon::now();
            session()->put('time',$time);
            //return $time;
            $o = (object)[];
            for($i=0;$i<$count;$i++)
            {
                $tb=new TicketBooking();
    
                $name=$data['name'][$i];
                $age=$data['age'][$i];
                $gender=$data['gender'][$i];
                $seat=$data['seat'][$i];
    
                $tb->baid=$baid;
                $tb->seatno=$seat;
                $tb->name=$name;
                $tb->age=$age;
                $tb->gender=$gender;
                $tb->phone=$phone;
                $tb->email=$email;
                $tb->price=$price;
                $tb->startstation=session()->get('starting');
                $tb->endstation=session()->get('ending');
                $tb->startdate=session()->get('date');
                $tb->enddate=session()->get('enddate');
                $tb->starttime=session()->get('starttime');
                $tb->endtime=session()->get('endtime');    
                $tb->time=$time;
                $tb->save();             
            }
            $number=session()->get('number');
            $data1=TicketBooking::Where('time',$time)->where('phone',$phone)->get();
            
            $r->session()->put('data',$data1);
           // return $data1;
            return redirect(route('tripbookingdone'));

        }
        else
        {
            return redirect()->back()->with('err','Your Otp Is Invalid');
        }
    }
    public function tripconfirm()
    {
        $data=session()->get('data');
      //  session()->put('time',$data['time']);
        return view('tripbookingdone', array('data'=>$data));
    }
    public function printticket(Request $r)
    {
       // $data=$r->all();
        $phone=$r->phone;
        $count=session()->get('total');
        $time=session()->get('time');
        $data1  =TicketBooking::Where('time',$time)->where('phone',$phone)->get();
        //return view('trippdf',array('data'=>$data1));
        view()->share('data',$data1);
        $pdf = PDF::loadView('trippdf');
        session()->flush();
        return $pdf->download('trippdf.pdf');
       // return view('trippdf',array('data'=>$data1));
    }
    public function logout(){
       // $this->guard()->logout();
        session()->remove('authority');
        return redirect()->route('home');
    }

    public function otpviewbooking(Request $r)
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
    public function viewtrip(Request $r)
    {
        $validate=$r->validate([
            'otp'=>['required',new CheckOtp],
        ]);
        $email=Session()->get('viewemail');
        $timedata=TicketBooking::where('email',$email)->get()->groupBy('time');
        foreach ($timedata as  $key=>$value) {
           $data=TicketBooking::where('email',$email)->where('time',$key)->get(['baid','time'])->first();
          // echo $data;
           $sdate=Busallocation::where('baid',$data->baid)->get(['startdate'])->first();
           $busid=Busallocation::where('baid',$data->baid)->get('bid')->first();
           $busnumber=Bus::where('bid',$busid->bid)->get('number')->first();
            foreach ($value as  $item) {
                $item->startdate = $sdate->date;
                $item->number=$busnumber->number; 
            }
           
        }
        //return "hello";
        //$datedata=Busallocation::whereIn('baid',$baid)->get('date');
        //return $timedata;
        return view('viewtrip',['data'=>$timedata]);
    }
    public function deletetripview(Request $r)
    {
        $email=$r->email;
        $time=$r->time;
        TicketBooking::where('time',$time)->where('email',$email)->delete();
        return redirect()->route('viewtripbooking');
    }
    public function printtripview(Request $r)
    {
        $email=$r->email;
        $time=$r->time;
        $data=TicketBooking::where('time',$time)->where('email',$email)->get(['baid','startdate','starttime','enddate','endtime','price','startstation','endstation','phone','email'])->first();
        $binddata=TicketBooking::where('time',$time)->where('email',$email)->get();
        $bid=Busallocation::where('baid',$data['baid'])->get('bid')->first();
        $number=Bus::where('bid',$bid)->get('number')->first();
        session()->put('number',$number['number']);
        session()->put('phone',$data['phone']);
        session()->put('email',$data['email']);
        session()->put('date',$data['startdate']);
        session()->put('starttime',$data['starttime']);
        session()->put('enddate',$data['enddate']);
        session()->put('endtime',$data['endtime']);
        session()->put('starting',$data['startstation']);
        session()->put('ending',$data['endstation']);
        $count=TicketBooking::where('time',$time)->where('email',$email)->count();
        $totalprice= $count*$data['price'];
        session()->put('totalprice',$totalprice);
        view()->share('data',$binddata);
        $pdf = PDF::loadView('trippdf');
       // session()->flush();
        return $pdf->download('trippdf.pdf');
       
       // return $data;
    }
}
