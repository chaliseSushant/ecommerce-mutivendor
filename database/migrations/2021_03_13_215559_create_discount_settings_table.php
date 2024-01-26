<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_settings', function (Blueprint $table) {
            $table->id();
            //first_purchase
            $table->boolean('fp_enabled')->default(0);
            $table->integer('fp_min')->nullable();
            $table->double('fp_discount')->nullable();
            $table->integer('duration')->default(15); //in days
            //referer
            $table->boolean('rfr_enabled')->default(0);
            $table->integer('rfr_min')->nullable();
            $table->double('rfr_discount')->nullable();
            $table->integer('rfr_duration')->default(15); //in days
            //referred
            $table->boolean('rfd_enabled')->default(0);
            $table->integer('rfd_min')->nullable();
            $table->double('rfd_discount')->nullable();
            $table->integer('rfd_duration')->default(15); //in days

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
        Schema::dropIfExists('discount_settings');
    }
}
