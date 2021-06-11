<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterchangeLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interchange_logs', function (Blueprint $table) {
            $table->id();
            $table->longText('data_send')->nullable();
            $table->dateTime('datetime_send')->nullable();
            $table->longText('response')->nullable();
            $table->string('response_status')->nullable();
            $table->dateTime('datetime_response')->nullable();
            $table->string('period')->nullable();
            $table->string('status_code')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interchange_logs');
    }
}
