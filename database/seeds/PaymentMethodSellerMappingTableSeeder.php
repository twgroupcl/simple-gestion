<?php

use Illuminate\Database\Seeder;

class PaymentMethodSellerMappingTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('payment_method_seller_mapping')->delete();
        
        \DB::table('payment_method_seller_mapping')->insert(array (
            0 => 
            array (
                'payment_method_id' => 1,
                'seller_id' => 1,
                'key' => '597044444402',
                'json_value' => NULL,
                'status' => 1,
                'created_at' => '2020-10-22 21:17:06',
                'updated_at' => '2020-10-22 21:17:06',
            ),
        ));
        
        
    }
}