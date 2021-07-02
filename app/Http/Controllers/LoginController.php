<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Login;
use App\Models\Station;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Foreach_;


class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function index()
    {
        return view('login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function verify_data(Request $req)
    {
        //$data=$req->all();
            // $user=Login::where(['username'=>$req->username,'password'=>$req->password])->get()->first();  
            // //print_r($user);
            // //   foreach ($user as $userr) {
               //dd(auth()->attempt(['username'=>$req->username,'password'=>$req->password]));
            if($this->guard()->attempt(['username'=>$req->username,'password'=>$req->password]))
            {
                if($this->guard()->user()->authority=='admin')
                {
                    session()->put('authority','admin');
                    return view('admin.dashboard');
                }
                else{
                    session()->put('authority','agent');
                    return view('agent.dashboard');
                }                
            }
            else
            {
                return back()->with('error', 'Wrong Credential');
            }
    }

    public function logout(){
            $this->guard()->logout();
            session()->remove('authority');
            return redirect(route('login'));
    }

    public function gethome()
    {
        $stationname = Station::get('sname');
        $stations=[];
        foreach ($stationname as  $value) {
            array_push($stations,$value->sname);
        }
        return view('home1',['stations' => $stations]);
    }

   
}


