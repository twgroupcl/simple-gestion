<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->comment('Identifier code transaction type');
            $table->string('name')->comment('Descriptive name');
            $table->text('description')->nullable()->comment('Description, notes or comments');
            $table->unsignedBigInteger('company_id')->comment('Company to which it belongs');
            $table->boolean('is_payment')->comment('Is (1)payment+ or (0)expense-?');
            $table->integer('status')->default(0)->comment('Manage status. 0 disable, 1 available, etc.');
            $table->timestamps();
        });

        Schema::table('transaction_types', function (Blueprint $table) {
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
        Schema::dropIfExists('transaction_types');
    }
}
