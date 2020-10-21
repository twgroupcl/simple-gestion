<?php

use Illuminate\Database\Seeder;

class ProductCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('product_categories')->delete();
        
        \DB::table('product_categories')->insert(array (
            0 => 
            array (
                'code' => '1',
                'company_id' => 1,
                'created_at' => '2020-10-21 13:54:46',
                'deleted_at' => NULL,
                'display_mode' => 'products_and_description',
                'id' => 1,
                'image' => '/storage/categories/990307231e3357c9704544e1bf22409c.jpg',
                'name' => 'General',
                'parent_id' => NULL,
                'position' => 0,
                'slug' => 'general',
                'status' => 1,
                'updated_at' => '2020-10-21 13:54:46',
            ),
        ));
        
        
    }
}