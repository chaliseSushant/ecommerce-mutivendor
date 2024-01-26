<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('shipping_type')->default(1);
            //1 : Base Shipping Per Vendor with Additional Shipping Per Quantity
            //2 : Base Shipping Per Order with Additional Shipping Per Quantity
            //3 : Base Shipping Per Order with Additional Shipping Per Item
            //4 : Base Shipping Per Order without Additional Shipping Charges
            //5 : Default Shipping Charge Policy
            //6 : Default Shipping Charge with Minimum Order Free
            //7 : Free Shipping
            $table->integer('default_shipping_charge')->default(0);
            $table->integer('minimum_order_amount')->default('1000');
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
        Schema::dropIfExists('settings');
    }
}
