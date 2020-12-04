<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingMethodProductMappingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_method_product_mapping', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shipping_method_id');
            $table->unsignedBigInteger('product_id');
            $table->longText('json_value')->nullable();
            $table->timestamps();
        });


        Schema::table('shipping_method_product_mapping', function (Blueprint $table) {
            $table->foreign('shipping_method_id')->references('id')->on('shipping_methods');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipping_method_product_mapping');
    }
}
