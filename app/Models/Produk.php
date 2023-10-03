<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'produks';
    protected $fillable = ['nama_produk', 'pcs', 'foto', 'harga'];

    public function pelayanan()
    {
        return $this->hasMany(Pelayanan::class);
   }
}
