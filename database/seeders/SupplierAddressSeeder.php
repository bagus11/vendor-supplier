<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SupplierAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('supplier_addresses')->insert([
            'supplierId' => 1,
            'supplierAddress' => 'RT/RW 001/001',
            'flagMainAddress' => '1',
            'supplierPhone' => '09876567897',
            'supplierEmail' => 'cintasejati69@gmail.com',
            'supplierWebsite' => 'cintasejati.com',
            'supplierFax' => '0219998888',
            'supplierProvince' => '11',
            'supplierCity' => '155',
            'supplierDistricts' => '1901',
            'supplierVillage' => '25234',
            'supplierPostalCode' => '23898',
            'supplierAddressType' => 'HO',
        ]);
    }
    // 11, 1101, 1101010, 1101010001
}
