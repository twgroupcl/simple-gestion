<?php

use Illuminate\Database\Seeder;

class ProductClassesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('product_classes')->delete();
        
        \DB::table('product_classes')->insert(array (
            0 => 
            array (
                'category_id' => 1,
                'company_id' => 1,
                'created_at' => '2020-10-21 13:55:04',
                'deleted_at' => NULL,
                'id' => 1,
                'name' => 'Campera',
                'status' => 1,
                'updated_at' => '2020-10-21 13:55:04',
            ),
        ));
        
        
    }
}