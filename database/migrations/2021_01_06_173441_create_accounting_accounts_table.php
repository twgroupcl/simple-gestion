<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountingAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->comment('Identifier code accounting');
            $table->string('name')->comment('Descriptive name for easy search');
            $table->text('description')->nullable()->comment('Description, notes or comments');
            $table->integer('number')->nullable()->comment('???');
            $table->unsignedBigInteger('company_id')->nullable()->comment('Company to which it belongs');
            $table->integer('status')->default(0)->comment('Manage status. 0 disable, 1 available, etc.');
            $table->timestamps();
        });

        Schema::table('accounting_accounts', function (Blueprint $table) {
            $table->foreign('company_id')->references('id')->on('companies');
            //TODO deben ser unicos? 
            $table->unique(['code']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounting_accounts');
    }
}
