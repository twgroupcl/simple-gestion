<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentMethodSellerMappingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_method_seller_mapping', function (Blueprint $table) {
            $table->unsignedBigInteger('payment_method_id');
            $table->unsignedBigInteger('seller_id');
            $table->string('key')->nullable();
            $table->longText('json_value')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });

        Schema::table('payment_method_seller_mapping', function (Blueprint $table) {
            $table->foreign('payment_method_id')->references('id')->on('payment_methods');
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
        Schema::dropIfExists('payment_method_seller_mapping');
    }
}
