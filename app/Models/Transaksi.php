<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    public static function nomorTransaksi(){
        $maxId = self::max('id');
        $prefix = "TRX";
        $date = date("Ymd");
        $kode = $prefix . $date . sprintf("%04s", $maxId + 1);
        return $kode;
    }
}
