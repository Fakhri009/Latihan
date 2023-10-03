<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pelayanans')->insert([
            'nama_pelayanan' => 'Reguler',
            'nama_model' => 'Comma Hair',
            'produk_id' => 1,
            
        ]);
        DB::table('pelayanans')->insert([
            'nama_pelayanan' => 'Spesial Fade',
            'nama_model' => 'Quif',
            'produk_id' => 2,
            
        ]);
        DB::table('pelayanans')->insert([
            'nama_pelayanan' => 'Spesial',
            'nama_model' => 'French Crop',
            'produk_id' => 3,
            
        ]);

    }
}
