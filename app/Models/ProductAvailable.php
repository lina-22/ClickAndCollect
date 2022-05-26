<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAvailable extends Model
{
    use HasFactory;

    public function products(){
        // return $this->belongsTo(Product::class);
        return $this->belongsTo(Product::class,"product_id");
    }

    public function reservation(){
        return $this->belongsToMany(Reservation::class, 'productAvail_reservation');
    }
}
