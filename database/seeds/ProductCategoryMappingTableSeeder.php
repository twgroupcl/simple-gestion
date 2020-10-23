<?php

use Illuminate\Database\Seeder;

class ProductCategoryMappingTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('product_category_mapping')->delete();
        
        \DB::table('product_category_mapping')->insert(array (
            0 => 
            array (
                'product_id' => 1,
                'product_category_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'product_id' => 2,
                'product_category_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'product_id' => 10,
                'product_category_id' => 6,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'product_id' => 13,
                'product_category_id' => 6,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}