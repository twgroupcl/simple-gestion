<?php

use Illuminate\Database\Seeder;

class ProductAttributesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('product_attributes')->delete();
        
        \DB::table('product_attributes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'product_id' => 1,
                'product_class_attribute_id' => 1,
                'json_value' => NULL,
                'created_at' => '2020-10-21 14:51:28',
                'updated_at' => '2020-10-21 14:51:28',
            ),
            1 => 
            array (
                'id' => 2,
                'product_id' => 2,
                'product_class_attribute_id' => 1,
                'json_value' => NULL,
                'created_at' => '2020-10-21 14:55:07',
                'updated_at' => '2020-10-21 14:55:07',
            ),
            2 => 
            array (
                'id' => 14,
                'product_id' => 11,
                'product_class_attribute_id' => 3,
                'json_value' => 'S',
                'created_at' => '2020-10-22 16:39:03',
                'updated_at' => '2020-10-22 16:39:03',
            ),
            3 => 
            array (
                'id' => 15,
                'product_id' => 11,
                'product_class_attribute_id' => 4,
                'json_value' => 'Negro',
                'created_at' => '2020-10-22 16:39:03',
                'updated_at' => '2020-10-22 16:39:03',
            ),
            4 => 
            array (
                'id' => 16,
                'product_id' => 12,
                'product_class_attribute_id' => 3,
                'json_value' => 'S',
                'created_at' => '2020-10-22 16:39:03',
                'updated_at' => '2020-10-22 16:39:03',
            ),
            5 => 
            array (
                'id' => 17,
                'product_id' => 12,
                'product_class_attribute_id' => 4,
                'json_value' => 'Rojo',
                'created_at' => '2020-10-22 16:39:03',
                'updated_at' => '2020-10-22 16:39:03',
            ),
            6 => 
            array (
                'id' => 18,
                'product_id' => 13,
                'product_class_attribute_id' => 4,
                'json_value' => '* No aplica',
                'created_at' => '2020-10-22 16:40:31',
                'updated_at' => '2020-10-22 16:40:31',
            ),
            7 => 
            array (
                'id' => 20,
                'product_id' => 14,
                'product_class_attribute_id' => 3,
                'json_value' => 'XS',
                'created_at' => '2020-10-22 16:40:31',
                'updated_at' => '2020-10-22 16:40:31',
            ),
            8 => 
            array (
                'id' => 21,
                'product_id' => 15,
                'product_class_attribute_id' => 3,
                'json_value' => 'S',
                'created_at' => '2020-10-22 16:40:31',
                'updated_at' => '2020-10-22 16:40:31',
            ),
        ));
        
        
    }
}