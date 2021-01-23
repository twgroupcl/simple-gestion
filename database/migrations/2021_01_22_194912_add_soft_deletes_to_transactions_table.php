<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftDeletesToTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->softDeletes();
        });
        
        Schema::table('transaction_types', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('bank_accounts', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('accounting_accounts', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('accounting_account_types', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('transaction_details', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        
        Schema::table('transaction_types', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('bank_accounts', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('accounting_accounts', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('accounting_account_types', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('transaction_details', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
