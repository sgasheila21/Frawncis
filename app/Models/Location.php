<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'city',
        'address',
        'opening_hours',
        'closing_hours',
        'image'
    ];

    public function carts (){
        return $this->belongsTo(Cart::class, 'id', 'location_id');
    }

    public function transactions (){
        return $this->belongsTo(Transaction::class, 'id', 'location_id');
    }
}
