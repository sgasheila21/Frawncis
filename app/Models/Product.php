<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
        'product_type_id',
        'image'
    ];

    public function productTypes (){
        return $this->hasOne(ProductType::class, 'id', 'product_type_id');
    }

    public function carts (){
        return $this->belongsTo(Cart::class, 'id', 'product_id');
    }

    public function transactions (){
        return $this->belongsTo(Transaction::class, 'id', 'product_id');
    }
}
