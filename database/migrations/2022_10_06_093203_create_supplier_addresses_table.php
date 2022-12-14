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
            $table->string('supplierEmail');
            $table->string('supplierWebsite')->nullable();
            $table->string('supplierFax')->nullable();
            $table->string('supplierProvince')->nullable();
            $table->string('supplierCity')->nullable();
            $table->string('supplierDistricts')->nullable();
            $table->string('supplierVillage')->nullable();
            $table->string('supplierPostalCode')->nullable();
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
