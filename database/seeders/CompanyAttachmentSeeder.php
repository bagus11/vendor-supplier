<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CompanyAttachmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('company_attachments')->insert([
            'supplierId' => 1,
            'numberPKP' => '1234567890',
            'numberNPWP' => '1234567890',
            'nameNPWP' => 'Kanjeng Zambo',
            'addressNPWP' => 'RT/RW 001/001',
            'fileNPWP' => 'app/public/npwp/npwp.pdf',
            'filePKP' => 'app/public/pkp/pkp.pdf',
            'fileRegistrationCertificate' => 'app/public/registrationCertificate/registrationCertificate.pdf',
            'fileCompanyProfile' => 'app/public/fileCompanyProfile/fileCompanyProfile.pdf',
        ]);
    }
}
