<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ISOSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('iso_masters')->insert([
            [
                'ISO' => 'ISO 9001',
                // 'created_at' => date('Y-m-d H:m:s'),
                // 'updated_at' => date('Y-m-d H:m:s'),
            ],
            [
                'ISO' => 'ISO 22000'
            ],
            [
                'ISO' => 'ISP/IEC 27001'
            ],
            [
                'ISO' => 'ISO 14001'
            ],
            [
                'ISO' => 'ISO TS 16949'
            ],
            [
                'ISO' => 'ISO 5001'
            ],
            [
                'ISO' => 'ISO/IEC 17025'
            ],
            [
                'ISO' => 'ISO 28000'
            ],
        ]);
    }
}
