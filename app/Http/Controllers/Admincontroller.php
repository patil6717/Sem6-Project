<?php

namespace App\Http\Controllers;

use App\Models\Route;
use App\Models\Routemap;
use App\Models\Shedule;
use App\Models\Busallocation;
use App\Models\Station;
use Illuminate\Http\Request;

class Admincontroller extends Controller
{
    
    public function getDashboard()
    {
        return view('admin.dashboard');
    }
 
   
    public function getTrip()
    {

    }
    public function getTour()
    {
        
    }
    public function getBushire()
    {
        
    }
    public function getBus()
    {
        
    }
    public function getDriver()
    {
        
    }

}
