<?php

use Illuminate\Database\Seeder;

class CustomerAddressesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('customer_addresses')->delete();
        
        \DB::table('customer_addresses')->insert(array (
            0 => 
            array (
                'id' => 1,
                'street' => 'Calle',
                'number' => '1',
                'subnumber' => '2',
                'commune_id' => 41,
                'uid' => '',
                'first_name' => '',
                'last_name' => '',
                'email' => '',
                'phone' => '',
                'cellphone' => '',
                'extra' => '',
                'customer_id' => 1,
                'created_at' => '2020-10-19 21:44:09',
                'updated_at' => '2020-10-19 21:44:09',
            ),
        ));
        
        
    }
}