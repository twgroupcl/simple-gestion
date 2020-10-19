<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uid');
            $table->string('name');
            $table->string('visible_name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('cellphone')->nullable();
            $table->string('web')->nullable();
            $table->string('password')->nullable();
            $table->boolean('is_company')->default(false);
            $table->longText('notes')->nullable();
            $table->longText('addresses_data')->nullable();
            $table->longText('activities_data')->nullable();
            $table->longText('banks_data')->nullable();
            $table->longText('contacts_data')->nullable();
            $table->boolean('is_approved')->default(false);
            $table->string('source')->default('admin');
            $table->integer('status')->default(1);
            $table->text('meta_title')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->longText('return_policy')->nullable();
            $table->longText('shipping_policy')->nullable();
            $table->longText('privacy_policy')->nullable();
            $table->boolean('commission_enable')->default(false);
            $table->decimal('commission_percentage', 12, 4)->default(0)->nullable();
            $table->string('logo')->nullable();
            $table->string('banner')->nullable();
            $table->longText('styles_json')->nullable();
            $table->unsignedBigInteger('seller_category_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('company_id');
            $table->timestamps();

            $table->softDeletes();
        });

        Schema::table('sellers', function (Blueprint $table) {
            $table->foreign('seller_category_id')->references('id')->on('seller_categories');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->unique(['company_id', 'uid']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sellers');
    }
}
