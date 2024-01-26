<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('sku');
            $table->string('name');
            $table->text('description');
            $table->boolean('instant_delivery')->default(0);
            $table->boolean('national_delivery')->default(1);
            $table->double('price', 8, 2);
            $table->double('display_price', 8, 2);
            $table->double('shipping_local_base', 10, 2)->default(0);
            $table->double('shipping_local_additional', 10, 2)->default(0);
            $table->double('shipping_national_base', 10, 2)->default(0);
            $table->double('shipping_national_additional', 10, 2)->default(0);
            $table->double('shipping_instant_base', 10, 2)->default(0);
            $table->double('shipping_instant_additional', 10, 2)->default(0);
            $table->boolean('status')->default(1);
            $table->boolean('stock')->default(1);
            $table->decimal('value',10,2);
            $table->string('thumbnail')->nullable();
            $table->bigInteger('brand_id')->unsigned()->nullable();
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->bigInteger('vendor_id')->unsigned()->nullable();
            $table->foreign('vendor_id')->references('id')->on('outlets');

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
        Schema::dropIfExists('products');
    }
}
