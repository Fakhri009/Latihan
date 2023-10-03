<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kapster extends Model
{
    use HasFactory;
    
    protected $fillable = ['nik', 'nama_kapster', 'telp', 'alamat', 'foto', 'laporan_id'];

  //  public function laporan()
  //  {
  //      return $this->belongsTo(Laporan::class, 'laporan_id');
  //  }
    public function laporan()
    {
        return $this->belongsTo(Laporan::class, 'laporan_id');
    }
}
