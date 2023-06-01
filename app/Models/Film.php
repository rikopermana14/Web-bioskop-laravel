<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $table = "tb_film";
    protected $primaryKey = "id";
    protected $fillable = [
        'judul',
        'director',
        'writer',
        'producer',
        'cast',
        'distributor',
        'image',
    ];
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'id_film');
    }

}
