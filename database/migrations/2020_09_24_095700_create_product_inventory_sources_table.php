<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductInventorySourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_inventory_sources', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('address_street');
            $table->string('address_number');
            $table->string('address_subnumber')->nullable();
            $table->unsignedBigInteger('commune_id');
            $table->string('contact_uid')->nullable();
            $table->string('contact_first_name')->nullable();
            $table->string('contact_last_name')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->integer('priority')->default(0);
            $table->decimal('latitude', 10, 5)->nullable();
            $table->decimal('longitude', 10, 5)->nullable();
            $table->integer('status')->default(1);
            $table->unsignedBigInteger('company_id');
            $table->timestamps();

            $table->softDeletes();
        });

        Schema::table('product_inventory_sources', function (Blueprint $table) {
            $table->foreign('commune_id')->references('id')->on('communes');
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
        Schema::dropIfExists('product_inventory_sources');
    }
}
