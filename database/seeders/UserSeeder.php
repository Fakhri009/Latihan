<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Kapster;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customer = Customer::all();
        $kapster = Kapster::all();

        DB::table('users')->insert([
            'name' => 'Fakhri',
            'email' => 'admin@mail.com',
            'password' => Hash::make('admin123'),
            'roles' => 'admin',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('users')->insert([
            'name' => 'Fakhri Agusriadi',
            'email' => 'fakhri@mail.com',
            'password' => Hash::make('fakhri123'),
            'roles' => 'admin',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

       // DB::table('users')->insert([
         //   'name' => 'Jamal',
           // 'email' => 'jamal@mail.com',
           // 'password' => Hash::make('fuad123'),
         //   'roles' => 'customer',
           // 'nic' => 'C01'
        //]);
        //DB::table('users')->insert([
          //  'name' => 'Abdi',
            //'email' => 'Abdi@mail.com',
           // 'password' => Hash::make('fuad123'),
            //'roles' => 'customer',
            //'nic' => 'C01'
       // ]);

       // DB::table('users')->insert([
         //   'name' => 'Fuad',
          //  'email' => 'fuad@mail.com',
           // 'password' => Hash::make('fuad123'),
           // 'roles' => 'Kapster',
           // 'nik' => 'K01'
        // ]);


        //foreach ($customer as $c) {
          //  DB::table('customers')->where('nic', $c->nic)->update([
           //     'user_id' => DB::table('users')->where('nic', $c->nic)->first()->id
          //  ]);
      //  }
        //foreach ($kapster as $k) {
         //   DB::table('kapsters')->where('nik', $k->nik)->update([
          //      'user_id' => DB::table('users')->where('nik', $k->nik)->first()->id
           // ]);
       // }
    }
}
