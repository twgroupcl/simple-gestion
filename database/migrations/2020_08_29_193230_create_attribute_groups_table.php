<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributeGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('position');
            $table->boolean('is_tab')->default(false);
            $table->boolean('is_user_defined')->default(1);
            $table->unsignedBigInteger('attribute_family_id');
        });

        Schema::table('attribute_groups', function (Blueprint $table) {
            $table->unique(['attribute_family_id', 'name']);
        });

        Schema::create('attribute_group_mapping', function (Blueprint $table) {
            $table->unsignedBigInteger('attribute_id');
            $table->unsignedBigInteger('attribute_group_id');
            $table->integer('position')->nullable();
        });

        Schema::table('attribute_group_mapping', function (Blueprint $table) {
            $table->primary(['attribute_id', 'attribute_group_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attribute_groups');
        Schema::dropIfExists('attribute_group_mapping');
    }
}
