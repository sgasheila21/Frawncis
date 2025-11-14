<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'location_id',
        'product_id',
        'quantity',
        'transaction_date'
    ];

    public function members (){
        return $this->belongsTo(User::class, 'member_id', 'id')->where('users.role_id',1);
    }

    public function admins (){
        return $this->belongsTo(User::class, 'admin_id', 'id')->where('users.role_id',2);
    }

    public function locations (){
        return $this->hasOne(Location::class, 'id', 'location_id');
    }

    public function products (){
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
