<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Barang extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_barang';
    protected $fillable = [
        'nama_barang',
        'satuan',
        'harga',
        
    ];

    public function transaksis()
    {
        return $this->HasMany(Transaksi::class, 'id_barang');
    }

    public function getHargaFormattedAttribute()
    {
        return 'Rp ' . number_format($this->attributes['harga'], 0, ',', '.');
    }
}
