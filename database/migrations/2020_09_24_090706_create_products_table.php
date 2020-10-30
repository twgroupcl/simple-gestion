<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_type_id');
            $table->unsignedBigInteger('product_class_id');
            $table->unsignedBigInteger('product_brand_id')->nullable();
            $table->string('sku');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->text('short_description')->nullable();
            $table->boolean('is_approved')->nullable()->default(null);
            $table->text('rejected_reason')->nullable();
            $table->date('date_of_rejected')->nullable();
            $table->boolean('is_service')->default(false);
            $table->boolean('is_template')->default(false);
            $table->string('url_key')->nullable();
            $table->boolean('new')->nullable();
            $table->boolean('featured')->nullable();
            $table->boolean('visible')->nullable();
            $table->date('visible_from')->nullable();
            $table->date('visible_to')->nullable();
            $table->unsignedBigInteger('currency_id');
            $table->decimal('price', 16, 4)->nullable();
            $table->decimal('cost', 16, 4)->nullable();
            $table->decimal('special_price', 16, 4)->nullable();
            $table->date('special_price_from')->nullable();
            $table->date('special_price_to')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->decimal('width', 12, 4)->nullable();
            $table->decimal('height', 12, 4)->nullable();
            $table->decimal('depth', 12, 4)->nullable();
            $table->decimal('weight', 12, 4)->nullable();
            $table->integer('critical_stock')->default(0);
            $table->boolean('use_inventory_control');
            $table->longText('inventories_json')->nullable();
            $table->longText('json_value')->nullable();
            $table->longText('images_json')->nullable();
            $table->longText('attributes_json')->nullable();
            $table->longText('variations_json')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('template_id')->nullable();
            $table->integer('status')->default(1);
            $table->unsignedBigInteger('seller_id');
            $table->unsignedBigInteger('company_id');
            $table->timestamps();

            $table->softDeletes();
        });

        Schema::table('products', function (Blueprint $table) {
            $table->foreign('product_type_id')->references('id')->on('product_types');
            $table->foreign('product_class_id')->references('id')->on('product_classes');
            $table->foreign('product_brand_id')->references('id')->on('product_brands');
            $table->foreign('currency_id')->references('id')->on('currencies');
            $table->foreign('parent_id')->references('id')->on('products');
            $table->foreign('template_id')->references('id')->on('products');
            $table->foreign('seller_id')->references('id')->on('sellers');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->unique(['company_id', 'seller_id', 'sku']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
