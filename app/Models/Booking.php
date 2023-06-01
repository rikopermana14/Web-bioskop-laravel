<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = "tb_booking";
    protected $primaryKey = "id";
    protected $fillable = [
        'id_user',
        'id_film',
        'kursi',
        'jam',
        'id_bioskop',
        'tanggal',
        'id_price',
    ];
    public function film()
    {
        return $this->belongsTo(Film::class, 'id_film');
    }

    public function bioskop()
    {
        return $this->belongsTo(Bioskop::class, 'id_bioskop');
    }
    public function price()
    {
        return $this->belongsTo(Bioskop::class, 'id_price');
    }
    public function seat()
    {
        return $this->belongsTo(Bioskop::class, 'kursi');
    }
    public function user()
    {
        return $this->belongsTo(Bioskop::class, 'id_user');
    }
}
