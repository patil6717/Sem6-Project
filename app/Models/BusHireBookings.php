<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusHireBookings extends Model
{
    use HasFactory;
    protected $table='bushirebooking';
    public $timestamps=false;
    protected $fillable=[
        'bhbid',
        'bhrid',
        'size',
        'bid',
        'did',
        'totalkm',
        'totalprice',
    ];
}
