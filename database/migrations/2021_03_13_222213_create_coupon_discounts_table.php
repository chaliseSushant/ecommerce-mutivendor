<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon_discounts', function (Blueprint $table) {
            $table->id();
            $table->string('coupon')->nullable();
            $table->string('discountable_type');
            $table->bigInteger('discountable_id');
            $table->integer('min')->nullable();
            $table->double('discount')->nullable();
            $table->tinyInteger('type')->nullable(); //0 for percent 1 for amount
            $table->dateTime('valid_from')->nullable();
            $table->dateTime('valid_to')->nullable();
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
        Schema::dropIfExists('coupon_discounts');
    }
}
