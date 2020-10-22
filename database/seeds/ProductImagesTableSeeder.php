<?php

use Illuminate\Database\Seeder;

class ProductImagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('product_images')->delete();
        
        \DB::table('product_images')->insert(array (
            0 => 
            array (
                'created_at' => NULL,
                'id' => 1,
                'path' => '/storage/products/ce3961b03ed287efdc51f6ecab3d3678.jpg',
                'product_id' => 1,
                'type' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'created_at' => NULL,
                'id' => 2,
                'path' => '/storage/products/6e1c5d780c688b32bde9e92d989d2ce5.jpg',
                'product_id' => 2,
                'type' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}