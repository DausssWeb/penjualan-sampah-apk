<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'user_id',
        'nomor_transaksi',
        'harga_id',
        'berat',
        'foto_sampah',
        'alamat',
        'waktu_penjemputan',
        'total_harga',
        'status',
        'pembayaran',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function nomorTransaksi(){
        $maxId = self::max('id') ?? 0;
        $prefix = "TRX";
        $date = date("Ymd");
        $kode = $prefix . $date . sprintf("%04s", $maxId + 1);
        return $kode;
    }

    public function harga(){
        return $this->belongsTo(Harga::class);
    }
}
