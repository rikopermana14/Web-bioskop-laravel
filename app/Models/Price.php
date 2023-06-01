<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $table = "tb_price";
    protected $primaryKey = "id";
    protected $fillable = [

        'tipe',
        'harga',
        
    ];
    public function booking()
    {
        return $this->hasMany(Booking::class, 'id_price');
    }
}
