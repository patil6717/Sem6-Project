<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Login extends Authenticatable
{
    use HasFactory;
    protected $table = 'logins';

    protected $guard="admin";
    protected $fillable = [
        'username',
        'authority',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    
}
