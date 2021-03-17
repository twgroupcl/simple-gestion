<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndExeToInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoice_items', function (Blueprint $table) {
            $table->boolean('ind_exe')->comment('item excepmt iva');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoice_items', function (Blueprint $table) {
            $table->dropColumn('ind_exe');
        });
    }
}
