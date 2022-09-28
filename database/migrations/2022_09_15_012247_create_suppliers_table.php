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
            $table->string('supplierEmail')->unique();
            $table->string('supplierWebsite')->nullable();
            $table->string('supplierFax')->nullable();
            $table->string('supplierType');
            $table->string('supplierProvince');
            $table->string('supplierCity');
            $table->string('supplierDistricts');
            $table->string('supplierWard');
            $table->text('supplierMainAddress');
            $table->text('supplierOtherAddress')->nullable();
            $table->string('supplierPostalCode');
            $table->string('supplierCategory');
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
