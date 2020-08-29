<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attributes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->unique();
            $table->string('admin_name');
            $table->integer('position')->nullable();
            $table->boolean('is_required')->default(0);
            $table->boolean('is_unique')->default(0);
            $table->boolean('is_filterable')->default(0);
            $table->boolean('is_configurable')->default(0);
            $table->boolean('is_user_defined')->default(1);
            $table->boolean('is_visible_on_front')->default(0);
            $table->longText('options')->nullable();
            $table->longText('library')->nullable();
            $table->longText('script')->nullable();
            $table->longText('validation')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
            $table->unsignedBigInteger('field_id');
            $table->unsignedBigInteger('company_id');

            $table->softDeletes();
        });

        Schema::table('attributes', function (Blueprint $table) {
            $table->foreign('field_id')->references('id')->on('attribute_fields');
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
        Schema::dropIfExists('attributes');
    }
}
