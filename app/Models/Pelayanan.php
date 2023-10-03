<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelayanan extends Model
{
    use HasFactory;

    protected $fillable = ['nama_pelayanan', 'nama_model', 'produk_id', 'harga'];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
    public function laporan()
    {
        return $this->belongsTo(Produk::class, 'laporan_id');
    }
}
