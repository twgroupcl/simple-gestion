<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('owner_uid')->nullable()->comment('RUT number or owner person unique identifier ');
            $table->string('owner_name')->nullable()->comment('Owner Full name');
            $table->integer('status')->default(0)->comment('Manage status account. 0 disable, 1 available, etc.');
            $table->string('account_number')->comment('Account identifier number');
            $table->unsignedBigInteger('bank_id')->comment('reference to bank table');
            $table->unsignedBigInteger('account_type_id')->comment('reference to bank account type');
            $table->unsignedBigInteger('company_id')->comment('Company to which it belongs');
            $table->timestamps();
        });
        
        Schema::table('bank_accounts', function (Blueprint $table) {
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('bank_id')->references('id')->on('banks');
            $table->foreign('account_type_id')->references('id')->on('bank_account_types');
            //$table->unique(['company_id', 'account_number', 'bank_id']); //TODO
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bank_accounts');
    }
}
