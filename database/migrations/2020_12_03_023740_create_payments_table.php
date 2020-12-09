<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('invoice_id');
            $table->integer('number_fee')->nullable();
            $table->longText('data_fee')->nullable();
            $table->string('payment_method')->nullable();
            $table->longText('data_payment')->nullable();
            $table->decimal('amount_total', 12, 4)->nullable();
            $table->decimal('amount_paid', 12, 4)->nullable();
            $table->integer('status')->default(1);
            $table->string('comments')->nullable();
            $table->timestamps();
        });
        
        Schema::table('payments', function (Blueprint $table) {
            $table->foreign('invoice_id')->references('id')->on('invoices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
