<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'fullname',
        'email',
        'password',
        'role_id',
        'profile_picture'
    ];

    public function roles (){
        return $this->hasOne(Role::class, 'id', 'role_id');
    }

    public function carts (){
        return $this->hasMany(Cart::class, 'member_id', 'id');
    }

    public function transactions (){
        return $this->hasMany(Transaction::class, 'member_id', 'id');
    }
}
