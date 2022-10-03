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
            'supplierName' => 'PT Mencari Cinta Sejati',
            'supplierPhone' => '087765434567',
            'supplierEmail' => 'cintasejati69@gmail.com',
            'supplierWebsite' => 'cintasejati.com',
            'supplierFax' => '0219998888',
            'supplierType' => 'Manufacture',
            'supplierProvince' => 'Banten',
            'supplierCity' => 'Kabupaten Tangerang',
            'supplierDistricts' => 'Bitung',
            'supplierWard' => 'Bitung Jaya',
            'supplierMainAddress' => 'RT/RW 001/001',
            'supplierOtherAddress' => 'RT/RW 001/001',
            'supplierPostalCode' => '15710',
            'supplierCategory' => 'PKP',
        ]);
    }
}
