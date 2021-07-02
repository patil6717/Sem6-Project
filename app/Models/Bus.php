<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;
    protected $table = 'buses';
    public $timestamps=false;
    protected $fillable = [
        'bid',
        'number',
        'capacity',
        'isWifi',
        'isAc',
        'isSleeper',
        'isAvailable',
    ];
}
