<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->double('shipping_charge', 10, 2)->default(0);
            $table->double('instant_charge', 10, 2)->default(0);
            $table->double('total_amount')->nullable();
            $table->double('discount', 10, 2)->default(0);
            $table->double('payable_amount', 10, 2)->nullable();
            $table->boolean('payment_complete')->default(0);
            $table->double('paid_amount', 10, 2)->nullable();
            $table->string('payment_method')->nullable();
            $table->bigInteger('cart_id')->unsigned()->nullable();
            $table->foreign('cart_id')->references('id')->on('carts');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            //$table->text('delivery_address')->nullable();
            $table->text('delivery_note')->nullable();
            $table->text('memo')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
