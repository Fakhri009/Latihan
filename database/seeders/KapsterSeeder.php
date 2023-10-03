<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KapsterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kapsters')->insert([
            'nama_kapster' => 'Fuad',
            'nik' => 'K01',
            'telp' => '081522790863',
            'alamat' => 'Jl Marlboro',
            'foto' => 'image.jpg',
            'laporan_id' => 1,
        ]);
        DB::table('kapsters')->insert([
            'nama_kapster' => 'Wahfi',
            'nik' => 'K02',
            'telp' => '081522790871',
            'alamat' => 'Jl Karang Paci',
            'foto' => 'image.jpg',
            'laporan_id' => 2,
        ]);
        DB::table('kapsters')->insert([
            'nama_kapster' => 'Zul',
            'nik' => 'K03',
            'telp' => '081522790829',
            'alamat' => 'Jl Alalak',
            'foto' => 'image.jpg',
            'laporan_id' => 3,
        ]);
    }
}
