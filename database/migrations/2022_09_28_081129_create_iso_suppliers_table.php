<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIsoSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iso_suppliers', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('isoId');
            $table->unsignedInteger('supplierId');
            $table->boolean('applied');
            $table->boolean('certified');
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
        Schema::dropIfExists('iso_suppliers');
    }
}
