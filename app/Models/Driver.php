<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;
    protected $table = 'drivers';

    public $timestamps=false;
    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'isAvailable',
    ];

}
