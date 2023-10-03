<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LaporanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   public function run()
   {
      //  DB::table('laporans')->insert([
      //      'kapster_id' => 1,
      //      'jumlah_potong' => '1',
      //      'produk_id' => 1,
       //     'pelayanan_id' => 1,
      //      'customer_id' => 1,
       // ]);
        DB::table('laporans')->insert([
            'jumlah_potong' => '5',
            'produk_id' => '2',
            'customer_id' => 2,
        ]);
        //DB::table('laporans')->insert([
       //     'jumlah_potong' => '4',
       //     'produk_id' => '3',
      //      'customer_id' => 3,
      //  ]);

    }
}
