<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterFormPenilaiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_form_penilaians', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('aspek_id');
            $table->integer('departement_id');
            $table->integer('pertanyaan_id');
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
        Schema::dropIfExists('master_form_penilaians');
    }
}
