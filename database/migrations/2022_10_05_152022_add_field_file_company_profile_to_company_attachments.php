<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldFileCompanyProfileToCompanyAttachments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_attachments', function (Blueprint $table) {
            $table->string('fileCompanyProfile')->after('fileRegistrationCertificate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_attachments', function (Blueprint $table) {
            $table->dropColumn('fileCompanyProfile');
        });
    }
}
