<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusHireRequest extends Model
{
    use HasFactory;
    protected $table='bushirerequests';
    public $timestamps=false;
    protected $fillable=[
        'fname',
        'lname',
        'phone',
        'email',
        'startdate',
        'starttime',
        'enddate',
        'endtime',
        'buscount',
        'size',
        'isWifi',
        'isAc',
        'isAccepted',
    ];
}
