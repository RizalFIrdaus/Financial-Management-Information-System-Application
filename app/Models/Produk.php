<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table = "produk";

    public function pesan()
    {
        return $this->hasMany(Pesan::class, 'kode_barang', 'kode_barang');
    }
}
