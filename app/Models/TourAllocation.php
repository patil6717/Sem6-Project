<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourAllocation extends Model
{
    use HasFactory;
    protected $table = 'tourallocation';
    public $timestamps=false;
}
