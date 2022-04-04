<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    // public function productAvailable(){
    //     return $this->belongsToMany(ProductAvailable::class,'productAvail_reservation');
    // }
    public function productLines(){
        return $this->hasMany(ProductLine::class, 'reservation_id');
    }
}
