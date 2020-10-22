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
                'created_at' => NULL,
                'product_category_id' => 1,
                'product_id' => 1,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'created_at' => NULL,
                'product_category_id' => 1,
                'product_id' => 2,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}