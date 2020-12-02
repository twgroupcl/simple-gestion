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
                'code' => 'free_shipping',
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 2,
                'json_value' => '',
                'status' => 1,
                'title' => 'Envio Gratis',
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'code' => 'flat_rate',
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 3,
                'json_value' => '',
                'status' => 1,
                'title' => 'Tarifa Fija',
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'code' => 'variable',
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 4,
                'json_value' => '',
                'status' => 1,
                'title' => 'Tarifa Variable',
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'code' => 'picking',
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 5,
                'json_value' => '',
                'status' => 1,
                'title' => 'Retiro en Tienda',
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}