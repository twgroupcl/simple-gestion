<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeUniqueCodeOnProductInventorySources extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_inventory_sources', function (Blueprint $table) {
            $table->dropUnique('product_inventory_sources_code_unique');
            $table->unique(['company_id', 'code']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_inventory_sources', function (Blueprint $table) {
            $table->dropUnique('product_inventory_sources_ompany_id_code_unique');
            $table->unique('code');
        });
    }
}
