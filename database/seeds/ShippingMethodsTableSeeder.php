<?php

use Illuminate\Database\Seeder;

class ShippingMethodsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('shipping_methods')->delete();
        
        \DB::table('shipping_methods')->insert(array (
            0 => 
            array (
                'code' => 'chilexpress',
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 1,
                'json_value' => NULL,
                'status' => 1,
                'title' => 'Chilexpress',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'code' => 'env',
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 2,
                'json_value' => '',
                'status' => 1,
                'title' => 'Envio Gratis',
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}