<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = ['jumlah_potong', 'produk_id', 'customer_id', 'kapster_id'];

   // public function customer()
   // {
     //   return $this->belongsTo(Customer::class, 'customer_id');
    //}
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
    public function kapster()
    {
        return $this->belongsTo(Kapster::class, 'kapster_id');
    }
    
   // public function pelayanan()
   // {
   //     return $this->belongsTo(Pelayanan::class, 'pelayanan_id');
  //  }
}


