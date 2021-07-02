<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shedule extends Model
{
    use HasFactory;
    protected $table = 'shedules';
    public $timestamps=false;

    protected $fillable = [
        'shid',
        'rid',
        'starttime',
    ];
}
