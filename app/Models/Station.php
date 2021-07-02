<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    use HasFactory;
    protected $table = 'stations';


    protected $fillable = [
        'sid',
        'sname',
        'location',
        'lattitude',
        'longitude',
        'cid',
    ];
}
