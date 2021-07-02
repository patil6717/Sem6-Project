<?php

namespace App\Http\Controllers;

use Illuminate\Cache\RedisTaggedCache;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function getDashboard()
    {
        return view('agent.dashboard');
    }
    public function logout(){
        $this->guard()->logout();
        session()->remove('authority');
        return redirect(route('login'));
}
    
}
