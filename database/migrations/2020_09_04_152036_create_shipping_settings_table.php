<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_settings', function (Blueprint $table) {
            $table->id();
            //Minimum For Enabling Home Delivery
            $table->boolean('enable_min_home_delivery_amount')->default(1);
            $table->integer('min_home_delivery_amount')->default(2000);
            //Minimum For Free Home Delivery
            $table->boolean('enable_min_free_home_delivery_amount')->default(1);
            $table->integer('min_free_home_delivery_amount')->default(3000);
            //Minimum For Free Courier
            $table->boolean('enable_min_free_courier_amount')->default(1);
            $table->integer('min_free_courier_amount')->default(1000);
            //Paid Delivery Charges
            $table->integer('courier_charge')->default(30);
            $table->integer('home_delivery_charge')->default(70);
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
        Schema::dropIfExists('shipping_settings');
    }
}
