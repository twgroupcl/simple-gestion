<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerSupportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_support', function (Blueprint $table) {
            $table->id();
            $table->string('contact_type');
            $table->string('subject');
            $table->string('name');
            $table->string('email');
            $table->string('details');
            $table->string('order')->nullable();
            $table->integer('status')->default(1);
            $table->unsignedBigInteger('seller_id')->nullable();
            $table->timestamps();
        });

        Schema::table('customer_support', function (Blueprint $table) {
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
        Schema::dropIfExists('customer_support');
    }
}
