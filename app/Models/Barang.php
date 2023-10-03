<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_barang', 'pcs', 'foto', 'harga'
    ];

  //  public function pelayanan()
  //  {
 //       return $this->belongsTo(Pelayanan::class, 'pelayanan_id', 'id');
   // }

 //   public function laporan()
 //   {
    //    return $this->belongsTo(Laporan::class, 'laporan_id', 'id');
  //  }
}
