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
                'id' => 1,
                'name' => 'General',
                'category_id' => NULL,
                'status' => 1,
                'created_at' => '2020-10-14 17:22:07',
                'updated_at' => '2020-10-14 17:22:07',
                'deleted_at' => NULL,
                'company_id' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Camiseta',
                'category_id' => 6,
                'status' => 1,
                'created_at' => '2020-10-14 17:22:42',
                'updated_at' => '2020-10-14 17:22:42',
                'deleted_at' => NULL,
                'company_id' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Computadora',
                'category_id' => 9,
                'status' => 1,
                'created_at' => '2020-10-14 17:22:52',
                'updated_at' => '2020-10-14 17:22:52',
                'deleted_at' => NULL,
                'company_id' => 1,
            ),
        ));
        
        
    }
}