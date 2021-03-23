<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBranchToSalesBoxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales_boxes', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('branch_id')->default(1);
            $table->text('remarks_open')->nullable()->after('remarks');;
            $table->text('remarks_close')->nullable()->after('remarks');;
            $table->dropColumn('remarks');
        });
        Schema::table('sales_boxes', function (Blueprint $table) {
            Schema::disableForeignKeyConstraints();
            $table->foreign('branch_id')->references('id')->on('branches');
            Schema::enableForeignKeyConstraints();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sales_boxes', function (Blueprint $table) {
            //

        });
    }
}
