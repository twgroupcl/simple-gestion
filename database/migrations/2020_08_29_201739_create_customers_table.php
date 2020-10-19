<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uid')->unique();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('cellphone')->nullable();
            $table->string('password')->nullable();
            $table->boolean('is_company')->default(false);
            $table->longText('notes')->nullable();
            $table->longText('addresses_data')->nullable();
            $table->longText('activities_data')->nullable();
            $table->longText('banks_data')->nullable();
            $table->longText('contacts_data')->nullable();
            $table->integer('status')->default(1);
            $table->unsignedBigInteger('customer_segment_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('company_id');
            $table->timestamps();

            $table->softDeletes();
        });

        Schema::table('customers', function (Blueprint $table) {
            $table->foreign('customer_segment_id')->references('id')->on('customer_segments');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('company_id')->references('id')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
