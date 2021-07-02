<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Routemap extends Model
{
    use HasFactory;
    protected $table = 'routemaps';
    public $timestamps=false;

    protected $fillable = [
        'rid',
        'sid',
        'sorder',
        'tfromp',
        'delay',
    ];
}
