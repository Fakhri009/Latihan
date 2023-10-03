<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['nic', 'pelayanan_id', 'nama_customer', 'telp', 'alamat', 'foto'];

    public function pelayanan() {
        return $this->belongsTo(Pelayanan::class, 'pelayanan_id');
    }
}
