<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    public function booking()
    {
        return $this->hasMany(Booking::class,'kursi');
    }
}

