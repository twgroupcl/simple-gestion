<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAccountingAccountTypeToAccountingAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounting_accounts', function (Blueprint $table) {
            $table->unsignedBigInteger('accounting_account_type_id')->nullable();
            $table->foreign('accounting_account_type_id')->references('id')->on('accounting_account_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accounting_accounts', function (Blueprint $table) {
            $table->dropForeign(['accounting_account_type_id']);
            $table->dropColumn('accounting_account_type_id');
            //
        });
    }
}
