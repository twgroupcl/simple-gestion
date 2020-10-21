<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cart_id');
            $table->string('method');
            $table->string('method_title');
            $table->timestamps();
        });

        Schema::table('cart_payments', function (Blueprint $table) {
            $table->foreign('cart_id')->references('id')->on('carts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_payments');
    }
}
