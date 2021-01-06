<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('transaction_type_id')
                  ->comment('Reference to type_transactions table, identifies if is payment or expense');
            $table->unsignedBigInteger('accounting_account_id')
                  ->comment('Reference to accounting_accounts table. Identifier accounting transaction');
            $table->string('document_identifier')->nullable()
                  ->comment('Document id or code, adjunt with document_model column');
            $table->unsignedBigInteger('bank_account_id')
                  ->comment('reference to the bank account that this transaction will impact');
            $table->unsignedBigInteger('company_id')->comment('reference to the which company it belongs');
            $table->dateTime('date')->comment('time when the transaction was made');
            $table->string('document_model')->nullable()->comment('Identifies the document model');
            $table->text('note')->nullable()->comment('notes or observations');
            $table->longText('json_value')->nullable()->comment('auxiliar column for more fields');
            $table->timestamps();
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('transaction_type_id')->references('id')->on('transaction_types');
            $table->foreign('accounting_account_id')->references('id')->on('accounting_accounts');
            $table->foreign('bank_account_id')->references('id')->on('bank_accounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
