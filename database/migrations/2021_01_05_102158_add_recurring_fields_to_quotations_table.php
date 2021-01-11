<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRecurringFieldsToQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quotations', function (Blueprint $table) {
            $table->boolean('is_recurring')->default(false);
            $table->longText('recurring_data')->nullable();
            $table->date('next_due_date')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('quotations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quotations', function (Blueprint $table) {
            $table->dropForeign('quotations_parent_id_foreign');
            $table->dropColumn('next_due_date');
            $table->dropColumn('is_recurring');
            $table->dropColumn('recurring_data');
            $table->dropColumn('parent_id');
        });
    }
}
