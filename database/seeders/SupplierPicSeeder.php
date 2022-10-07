<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SupplierPicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pics')->insert([
            'supplierId' => 1,
            'picName' => 'Kanjeng Zambo',
            'picDepartement' => 'Jendral bintang 7',
            'picPhone' => '087656789876',
            'picEmail' => 'zambo96@rocketmail.com',
        ]);
    }
}
