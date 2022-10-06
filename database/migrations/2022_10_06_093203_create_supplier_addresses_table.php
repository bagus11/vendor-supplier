<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('supplierId');
            $table->text('supplierAddress');
            $table->boolean('flagMainAddress');
            $table->string('supplierPhone');
            $table->string('supplierEmail')->unique();
            $table->string('supplierWebsite')->nullable();
            $table->string('supplierFax')->nullable();
            $table->string('supplierProvince');
            $table->string('supplierCity');
            $table->string('supplierDistricts');
            $table->string('supplierVillage');
            $table->string('supplierPostalCode');
            $table->string('supplierAddressType');
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
        Schema::dropIfExists('supplier_addresses');
    }
}
