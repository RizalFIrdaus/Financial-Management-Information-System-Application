<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    use HasFactory;

    protected $table = "pesan";



    public function produk()
    {
        return $this->belongsTo(Produk::class, 'kode_barang', 'kode_barang');
    }
    public function profit()
    {
        return $this->belongsTo(Profit::class, 'nomor_po', 'nomor_po');
    }
}
