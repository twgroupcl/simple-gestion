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
                'id' => 1,
                'type' => NULL,
                'path' => '/storage/products/ce3961b03ed287efdc51f6ecab3d3678.jpg',
                'product_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'type' => NULL,
                'path' => '/storage/products/6e1c5d780c688b32bde9e92d989d2ce5.jpg',
                'product_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 6,
                'type' => NULL,
                'path' => '/storage/products/da9e9d056d3ad22550d64ecc642bac72.jpg',
                'product_id' => 10,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 7,
                'type' => NULL,
                'path' => '/storage/products/5e92a015ae3c95d0d1206a2000071a20.jpg',
                'product_id' => 11,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 8,
                'type' => NULL,
                'path' => '/storage/products/d9bb4d7f36259df23a408d8120127e60.jpg',
                'product_id' => 12,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 9,
                'type' => NULL,
                'path' => '/storage/products/7bff1b7496b68613c31e0998116dd561.jpg',
                'product_id' => 13,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 10,
                'type' => NULL,
                'path' => '/storage/products/bef23aebc2ef96e177572c9383d31105.jpg',
                'product_id' => 14,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 11,
                'type' => NULL,
                'path' => '/storage/products/5c61f379d9b6955999143499bced51cf.jpg',
                'product_id' => 15,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}