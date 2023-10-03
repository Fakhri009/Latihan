<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('produks')->insert([
            'nama_produk' => 'Tezzen',
            'pcs' => '10',
            'foto' => 'image.jpg',
            'harga' => 'Rp 140.000',
        ]);
        DB::table('produks')->insert([
            'nama_produk' => 'Hairneds',
            'pcs' => '15',
            'foto' => 'image.jpg',
            'harga' => 'Rp 180.000',
        ]);
        DB::table('produks')->insert([
            'nama_produk' => 'Crazy Color',
            'pcs' => '5',
            'foto' => 'image.jpg',
            'harga' => 'Rp 220.000',
        ]);

    }
}
