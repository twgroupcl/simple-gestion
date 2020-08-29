<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('tax');
            $table->string('tributary_category');
            $table->boolean('net_available');
            $table->unsignedBigInteger('country_id');
            $table->timestamps();

            $table->softDeletes();
        });

        Schema::table('business_activities', function (Blueprint $table) {
            $table->foreign('country_id')->references('id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_activities');
    }
}
