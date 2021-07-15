<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndExeToInvoicesAndQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoice_items', function (Blueprint $table) {
            $table->integer('ind_exe')->default(0);
        });

        Schema::table('quotation_items', function (Blueprint $table) {
            $table->integer('ind_exe')->default(0);
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

        Schema::table('quotation_items', function (Blueprint $table) {
            $table->dropColumn('ind_exe');
        });
    }
}
