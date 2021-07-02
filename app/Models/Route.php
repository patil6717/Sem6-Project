<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Route extends Model
{
    use HasFactory;
    use Sortable;
    protected $table = 'routes';
    public $timestamps=false;

    protected $fillable = [
        'rid',
        'from_st',
        'to_st',
        'via',
    ];
    public $sortable = ['rid',
    'from_st',
    'to_st'];
}
