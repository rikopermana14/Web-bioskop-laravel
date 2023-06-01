<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bioskop extends Model
{
    protected $tabel = "bioskops";
    protected $primaryKey = "id";
    protected $fillable = [
        'nama',
        'lokasi',
        
    ];
    public function booking()
    {
        return $this->hasMany(Booking::class, 'id_bioskop');
    }
}
