<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('barangs')->insert([
            'nama_barang' => 'Pomade',
            'pcs' => '10',
            'foto' => 'image.jpg',
            'harga' => 'Rp 140.000',
        ]);

    }
}
