<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\Busallocation;
use App\Models\BusMaintanance;
use App\Models\Driver;
use App\Models\Route;
use App\Models\Shedule;
use App\Models\Station;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $bus=Bus::count('bid');
        $busonmain=BusMaintanance::count('bid');
        $driver=Driver::count('did');
        $station=Station::count('sid');
        $route=Route::count('rid');
        $shedule=Shedule::count('shid');
        $today=Carbon::now()->format('Y-m-d');
        $busontoday=Busallocation::where('startdate',$today)->count('baid');
        return view('dashboard')->with(['bus'=>$bus,'busonmain'=>$busonmain,'driver'=>$driver,'station'=>$station,'route'=>$route,'shedule'=>$shedule,'busontoday'=>$busontoday]);
    }
}
