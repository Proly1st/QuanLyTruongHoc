<?php

namespace App\Models;

use App\Http\Middleware\Authenticate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Staff extends Authenticatable
{
    use HasApiTokens ,Notifiable;
    protected $table = 'staff';
    protected $primaryKey = 'id';


    protected $fillable = [
        'name',
        'phone',
        'password',
    ];
}
