<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'product_id',
        'quantity'
    ];

    public function locations (){
        return $this->hasOne(Location::class, 'id', 'location_id');
    }

    public function products (){
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function users (){
        return $this->belongsTo(User::class, 'member_id', 'id');
    }
}
