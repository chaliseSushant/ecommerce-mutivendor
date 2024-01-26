<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentGatewaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_gateways', function (Blueprint $table) {
            $table->id();
            $table->boolean('esewa_enable')->default(0);
            $table->string('esewa_secret_key')->nullable();
            $table->string('esewa_public_key')->nullable();
            $table->boolean('khalti_enable')->default(0);
            $table->string('khalti_secret_key')->nullable();
            $table->string('khalti_public_key')->nullable();
            $table->boolean('fonepay_enable')->default(0);
            $table->string('fonepay_qr')->nullable();
            $table->boolean('cod_enable')->default(0);
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
        Schema::dropIfExists('payment_gateways');
    }
}
