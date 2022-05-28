<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductLine extends Pivot
{
    use HasFactory;


    //protected $table="product_lines";
    // protected $primaryKey=["reservation_id","product_available_id"];
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }



    public function proAvl(){
        return $this->belongsTo(ProductAvailable::class, 'product_available_id');
    }
}
