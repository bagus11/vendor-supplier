<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SuppliersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('suppliers')->insert([
            'userId' => 1,
            'supplierName' => 'PT Mencari Cinta Sejati',
            'supplierType' => 'Manufacture',
            'supplierCategory' => 'PKP',
            'supplierYearOfEstablishment' => '1945',
            'supplierNumberOfEmployee' => '1000',
        ]);
    }
}
