<?php

use Illuminate\Database\Seeder;

class ProductSuperAttributesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('product_super_attributes')->delete();
        
        \DB::table('product_super_attributes')->insert(array (
            0 => 
            array (
                'product_id' => 10,
                'product_class_attribute_id' => 3,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'product_id' => 10,
                'product_class_attribute_id' => 4,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'product_id' => 13,
                'product_class_attribute_id' => 3,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}