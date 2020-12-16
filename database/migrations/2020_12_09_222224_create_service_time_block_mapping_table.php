<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceTimeBlockMappingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_time_block_mapping', function (Blueprint $table) {
            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('time_block_id');
            $table->timestamps();
        });

        Schema::table('service_time_block_mapping', function (Blueprint $table) {
            $table->foreign('service_id')->references('id')->on('services');
            $table->foreign('time_block_id')->references('id')->on('time_blocks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_time_block_mapping');
    }
}
