<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributeFamiliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_families', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->string('name');
            $table->boolean('is_user_defined')->default(true);
            $table->integer('status')->default(1);
            $table->timestamps();
            $table->unsignedBigInteger('attribute_module_id');
            $table->unsignedBigInteger('company_id');
        });

        Schema::table('attribute_families', function (Blueprint $table) {
            $table->foreign('attribute_module_id')->references('id')->on('attribute_modules');
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
        Schema::dropIfExists('attribute_families');
    }
}
