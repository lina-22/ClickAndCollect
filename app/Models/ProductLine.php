<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductLine extends Model
{
    use HasFactory;

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function proAvl(){
        return $this->belongsTo(ProductAvailable::class, 'product_available_id');
    }
}
