<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_blocks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('day_of_week')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('code');
            $table->boolean('status');
            $table->longText('json_value')->nullable();
            $table->unsignedBigInteger('company_id');
            $table->timestamps();

            $table->softDeletes();
        });

        Schema::table('time_blocks', function (Blueprint $table) {
            $table->foreign('company_id')->references('id')->on('companies');
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
        Schema::dropIfExists('time_blocks');
    }
}
