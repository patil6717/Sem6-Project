<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pickanddrop extends Model
{
    use HasFactory;
    protected $table = 'picanddrops';


    protected $fillable = [
        'rid',
        'sid',
        'location',
    ];
}
