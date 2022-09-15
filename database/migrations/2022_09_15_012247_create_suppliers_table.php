<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('supplierName');
            $table->string('supplierPhone');
            $table->string('email')->unique();
            $table->text('supplierDescription');
            $table->string('supplierNPWP');
            $table->string('supplierNPWPFile');
            $table->string('supplierSIUP');
            $table->string('supplierSIUPFile');
            $table->unsignedInteger('ProductId');
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
        Schema::dropIfExists('suppliers');
    }
}
