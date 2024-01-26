<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone'); //Main Number For Official Purpose Only - Main Number
            $table->string('alt_phone')->nullable(); //Secondary Number For Official Purpose Only
            $table->text('address')->nullable();
            $table->boolean('certified')->default(0); //For Premium Store
            $table->string('email')->nullable(); //For Official Purpose Only
            $table->string('cover')->nullable(); //Cover Image of Vendor
            $table->string('icon')->nullable(); //Icon or Profile Image of Vendor
            $table->string('status')->default(0); //Only Ecommerce Can Change This Status
            $table->bigInteger('vendor_type_id')->unsigned()->nullable();
            $table->foreign('vendor_type_id')->references('id')->on('vendor_types');
            $table->dateTime('approved_at')->nullable();
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
        Schema::dropIfExists('vendors');
    }
}
