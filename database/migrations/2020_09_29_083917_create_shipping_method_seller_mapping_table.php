<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingMethodSellerMappingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_method_seller_mapping', function (Blueprint $table) {
            $table->unsignedBigInteger('shipping_method_id');
            $table->unsignedBigInteger('seller_id');
            $table->string('key')->nullable();
            $table->longText('json_value')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });

        Schema::table('shipping_method_seller_mapping', function (Blueprint $table) {
            $table->foreign('shipping_method_id')->references('id')->on('shipping_methods');
            $table->foreign('seller_id')->references('id')->on('sellers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipping_method_seller_mapping');
    }
}
