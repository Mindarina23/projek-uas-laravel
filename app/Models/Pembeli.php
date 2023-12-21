<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembeli extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pembeli';
    protected $fillable = [
        'nama_pembeli',
        'alamat',
        'no_hp',    
    ];

    public function transaksis()
    {
        return $this->HasMany(Transaksi::class, 'id_pembeli');
    }

}
