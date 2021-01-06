<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('value', 12, 4)->comment('amount transaction');
            $table->unsignedBigInteger('currency_id')->nullable()->comment('determine currency');
            $table->unsignedBigInteger('transaction_id')->comment('reference to the transaction');
            $table->longText('json_detail')->nullable()->comment('auxiliar column for more fields');
            $table->timestamps();
        });

        Schema::table('transaction_details', function (Blueprint $table) {
            $table->foreign('currency_id')->references('id')->on('currencies');
            $table->foreign('transaction_id')->references('id')->on('transactions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_details');
    }
}
