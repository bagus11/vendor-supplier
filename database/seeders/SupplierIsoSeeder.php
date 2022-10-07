<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SupplierIsoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('iso_suppliers')->insert([
            'isoId' => 1,
            'supplierId' => 1,
            'applied' => 1,
            'certified' => 1,
        ]);
    }
}
