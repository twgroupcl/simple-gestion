<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('old_id');
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
            $table->decimal('price', 12, 4)->nullable();
            $table->decimal('cost', 12, 4)->nullable();
            $table->decimal('special_price', 12, 4)->nullable();
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
            $table->timestamp('deleted_at');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_logs');
    }
}
