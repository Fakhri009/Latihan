<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            'nama_customer' => 'Jamal',
            'nic' => 'C01',
            'pelayanan_id' => '1',
            'telp' => '081522790863',
            'alamat' => 'Jl Marlboro',
            'foto' => 'image.jpg',

        ]);
        DB::table('customers')->insert([
            'nama_customer' => 'Amat',
            'nic' => 'C02',
            'pelayanan_id' => '2',
            'telp' => '081522790861',
            'alamat' => 'Jl Handil Bakti',
            'foto' => 'image.jpg',

        ]);
        DB::table('customers')->insert([
            'nama_customer' => 'Ari',
            'nic' => 'C03',
            'pelayanan_id' => '3',
            'telp' => '081522790865',
            'alamat' => 'Jl Perdagangan',
            'foto' => 'image.jpg',

        ]);
    }
}
