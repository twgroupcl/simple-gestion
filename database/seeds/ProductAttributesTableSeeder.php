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
                'created_at' => '2020-10-21 14:51:28',
                'id' => 1,
                'json_value' => NULL,
                'product_class_attribute_id' => 1,
                'product_id' => 1,
                'updated_at' => '2020-10-21 14:51:28',
            ),
            1 => 
            array (
                'created_at' => '2020-10-21 14:55:07',
                'id' => 2,
                'json_value' => NULL,
                'product_class_attribute_id' => 1,
                'product_id' => 2,
                'updated_at' => '2020-10-21 14:55:07',
            ),
        ));
        
        
    }
}