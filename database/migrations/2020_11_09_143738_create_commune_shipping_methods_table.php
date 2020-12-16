<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommuneShippingMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commune_shipping_methods', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('commune_id')->nullable();
            $table->unsignedBigInteger('seller_id');
            $table->unsignedBigInteger('company_id');
            $table->boolean('is_global')->default(false);
            $table->longText('active_methods')->nullable();
            $table->longText('shipping_methods')->nullable();
            $table->longText('json_value')->nullable();

            $table->timestamps();
        });

        Schema::table('commune_shipping_methods', function (Blueprint $table) {
            $table->foreign('seller_id')->references('id')->on('sellers');
            $table->foreign('commune_id')->references('id')->on('communes');
            $table->foreign('company_id')->references('id')->on('companies');

            $table->unique(['company_id', 'seller_id', 'commune_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commune_shipping_methods');
    }
}
