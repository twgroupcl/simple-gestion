<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('street');
            $table->string('number');
            $table->string('subnumber')->nullable();
            $table->unsignedBigInteger('commune_id');
            $table->string('uid')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('cellphone')->nullable();
            $table->text('extra')->nullable();
            $table->unsignedBigInteger('customer_id');
            $table->timestamps();
        });

        Schema::table('customer_addresses', function (Blueprint $table) {
            $table->foreign('commune_id')->references('id')->on('communes');
            $table->foreign('customer_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_addresses');
    }
}
