<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('products')->delete();
        
        \DB::table('products')->insert(array (
            0 => 
            array (
                'attributes_json' => '{"attribute-1":null}',
                'company_id' => 1,
                'cost' => NULL,
                'created_at' => '2020-10-21 14:47:50',
                'critical_stock' => 0,
                'currency_id' => 63,
                'date_of_rejected' => NULL,
                'deleted_at' => NULL,
                'depth' => '1.0000',
                'description' => '<p>Campera de plum&oacute;n para climas extremadamente fr&iacute;os. El dise&ntilde;o est&aacute; pensado para optimizar el poder expansivo del plum&oacute;n y, por lo tanto, su capacidad aislante. Est&aacute; rellena de plum&oacute;n ALLIED&reg; de alt&iacute;sima calidad. Tejido exterior WINDSTOPPER&reg; Insulation.</p>',
                'featured' => 0,
                'height' => '1.0000',
                'id' => 1,
                'images_json' => '"[{\\"image\\":\\"\\\\\\/storage\\\\\\/products\\\\\\/ce3961b03ed287efdc51f6ecab3d3678.jpg\\"}]"',
                'inventories_json' => NULL,
                'is_approved' => 1,
                'is_service' => 0,
                'is_template' => 0,
                'json_value' => NULL,
                'meta_description' => NULL,
                'meta_keywords' => NULL,
                'meta_title' => NULL,
                'name' => 'CAMPERA ANTÁRTIDA 2',
                'new' => 0,
                'parent_id' => NULL,
                'price' => '46800.0000',
                'product_brand_id' => NULL,
                'product_class_id' => 1,
                'product_type_id' => 1,
                'rejected_reason' => NULL,
                'seller_id' => 1,
                'short_description' => 'CAMPERA ANTÁRTIDA 2',
                'sku' => 'ca2-123',
                'special_price' => NULL,
                'special_price_from' => NULL,
                'special_price_to' => NULL,
                'status' => 1,
                'template_id' => NULL,
                'updated_at' => '2020-10-21 14:52:34',
                'url_key' => 'campera-antrtida-2',
                'use_inventory_control' => 0,
                'variations_json' => NULL,
                'visible' => 0,
                'visible_from' => NULL,
                'visible_to' => NULL,
                'weight' => '1.0000',
                'width' => '1.0000',
            ),
            1 => 
            array (
                'attributes_json' => '{"attribute-1":null}',
                'company_id' => 1,
                'cost' => NULL,
                'created_at' => '2020-10-21 14:54:22',
                'critical_stock' => 0,
                'currency_id' => 63,
                'date_of_rejected' => NULL,
                'deleted_at' => NULL,
                'depth' => '1.0000',
                'description' => '<p>Campera t&eacute;cnica de alta monta&ntilde;a para expediciones y largas traves&iacute;as. 100 % impermeable y cortaviento, alta respirabilidad y bajo peso. Tejido GORE-TEX&reg; 3C PRO mejora resistencia a la abrasi&oacute;n interna y enganches.</p>',
                'featured' => 0,
                'height' => '1.0000',
                'id' => 2,
                'images_json' => '"[{\\"image\\":\\"\\\\\\/storage\\\\\\/products\\\\\\/6e1c5d780c688b32bde9e92d989d2ce5.jpg\\"}]"',
                'inventories_json' => NULL,
                'is_approved' => 1,
                'is_service' => 0,
                'is_template' => 0,
                'json_value' => NULL,
                'meta_description' => NULL,
                'meta_keywords' => NULL,
                'meta_title' => NULL,
                'name' => 'CAMPERA ACONCAGUA 4 PARA EXPEDICIÓN',
                'new' => 0,
                'parent_id' => NULL,
                'price' => '41700.0000',
                'product_brand_id' => NULL,
                'product_class_id' => 1,
                'product_type_id' => 1,
                'rejected_reason' => NULL,
                'seller_id' => 1,
                'short_description' => 'CAMPERA ACONCAGUA 4 PARA EXPEDICIÓN',
                'sku' => 'ca4-123',
                'special_price' => NULL,
                'special_price_from' => NULL,
                'special_price_to' => NULL,
                'status' => 1,
                'template_id' => NULL,
                'updated_at' => '2020-10-21 14:55:07',
                'url_key' => 'campera-aconcagua-4-para-expedicin',
                'use_inventory_control' => 0,
                'variations_json' => NULL,
                'visible' => 0,
                'visible_from' => NULL,
                'visible_to' => NULL,
                'weight' => '0.4800',
                'width' => '1.0000',
            ),
        ));
        
        
    }
}