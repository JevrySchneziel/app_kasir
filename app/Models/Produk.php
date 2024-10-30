<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'gambar',
        'nama_produk',
        'barcode',
        'harga',
        'stok',    
    ];

    public function detail_penjualan()
    {
        return $this->hasMany(DetailPenjualan::class, 'id_produk', 'id');
    }
}
