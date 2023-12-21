<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_transaksi';
    protected $fillable = [
        'id_pembeli',
        'id_barang',
        'jumlah',
        'harga',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    public function pembeli()
    {
        return $this->belongsTo(Pembeli::class, 'id_pembeli');
    }

    public function getHargaFormattedAttribute()
    {
        return 'Rp ' . number_format($this->attributes['harga'], 0, ',', '.');
    }

}
