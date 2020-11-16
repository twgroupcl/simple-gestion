<?php

use Illuminate\Database\Seeder;

class FilsaProductClassesTableSeeder extends Seeder
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
                'name' => 'Libro',
                'code' => 'book',
                'category_id' => NULL,
                'status' => 1,
                'company_id' => 1,
                'created_at' => '2020-11-16 12:55:00',
                'updated_at' => '2020-11-16 12:55:00',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}