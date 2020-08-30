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
            $table->string('uid');
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
            $table->integer('status')->default(1);
            $table->unsignedBigInteger('branch_id');
            $table->timestamps();

            $table->softDeletes();
        });

        Schema::table('customers', function (Blueprint $table) {
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->unique(['branch_id', 'uid']);
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
