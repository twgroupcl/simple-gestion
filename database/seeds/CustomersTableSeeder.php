<?php

use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('customers')->delete();
        
        \DB::table('customers')->insert(array (
            0 => 
            array (
                'id' => 1,
                'uid' => '55.555.555-5',
                'first_name' => 'Cliente',
                'last_name' => 'Prueba',
                'email' => 'cliente@prueba.com',
                'phone' => NULL,
                'cellphone' => NULL,
                'password' => NULL,
                'is_company' => 0,
                'notes' => NULL,
                'addresses_data' => '[{"street":"Calle","number":"1","subnumber":"2","commune_id":"41","uid":"","first_name":"","last_name":"","email":"","phone":"","cellphone":"","extra":""}]',
                'activities_data' => '[]',
                'banks_data' => '[]',
                'contacts_data' => '[]',
                'status' => 1,
                'customer_segment_id' => 1,
                'user_id' => NULL,
                'company_id' => 1,
                'created_at' => '2020-10-19 21:44:09',
                'updated_at' => '2020-10-19 21:44:09',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}