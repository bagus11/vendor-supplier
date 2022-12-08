<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterFormPenilaianHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_form_penilaian_headers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('rating_code');
            $table->string('supplier_name');
            $table->integer('flg_aktif');
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
        Schema::dropIfExists('master_form_penilaian_headers');
    }
}
