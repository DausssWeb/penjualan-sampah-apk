<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Harga extends Model
{
    protected $fillable = [
        'jenis_sampah', 
        'hargaPerKg'
    ];

    public function transaksi(){
        return $this->hasMany(Transaksi::class);
    }
}
