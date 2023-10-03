<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\BarangSeeder;
use Database\Seeders\ProdukSeeder;
use Database\Seeders\KapsterSeeder;
use Database\Seeders\LaporanSeeder;
use Database\Seeders\CustomerSeeder;
use Database\Seeders\PelayananSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ProdukSeeder::class);
        $this->call(PelayananSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(LaporanSeeder::class);
        $this->call(BarangSeeder::class);
        $this->call(KapsterSeeder::class);
        $this->call(UserSeeder::class);
    }
}
