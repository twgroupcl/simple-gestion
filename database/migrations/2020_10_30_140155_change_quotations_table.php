<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quotations', function (Blueprint $table) {
            $table->decimal('discount_percent', 16, 4)->nullable()->change();
            $table->decimal('discount_amount', 16, 4)->nullable()->change();
            $table->unsignedInteger('items_count')->default(0)->change();
            $table->unsignedInteger('items_qty')->default(0)->change();
            $table->decimal('discount_total', 16, 4)->nullable()->change();
            $table->decimal('sub_total', 16, 4)->nullable()->change();
            $table->decimal('net', 16, 4)->nullable()->change();
            $table->decimal('total', 16, 4)->nullable()->change();
            $table->decimal('tax_amount', 16, 4)->nullable()->change();
            $table->decimal('tax_total', 16, 4)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
