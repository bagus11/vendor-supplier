<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_attachments', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('supplierId');
            $table->string('numberPKP');
            $table->string('numberNPWP');
            $table->string('nameNPWP');
            $table->string('addressNPWP');
            $table->string('fileNPWP');
            $table->string('filePKP');
            $table->string('fileRegistrationCertificate');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_attachments');
    }
}
