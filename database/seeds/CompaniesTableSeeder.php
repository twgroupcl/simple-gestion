<?php

use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('companies')->delete();
        
        \DB::table('companies')->insert(array (
            0 => 
            array (
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 1,
                'logo' => NULL,
                'name' => 'TWGroup',
                'payment_data' => NULL,
                'real_name' => 'Sociedad de empresa',
                'status' => 1,
                'uid' => '76252357-4',
                'unique_hash' => '1269616902103f28d121374c7d269e00',
                'updated_at' => '2020-08-22 10:46:38',
            ),
            1 => 
            array (
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 2,
                'logo' => NULL,
                'name' => 'Ejemplo',
                'payment_data' => NULL,
                'real_name' => 'Sociedad de ejemplo',
                'status' => 1,
                'uid' => '55555555-5',
                'unique_hash' => '234944671d293c50919d764456af71c8',
                'updated_at' => '2020-08-22 10:46:38',
            ),
            2 => 
            array (
                'created_at' => '2020-10-18 21:57:16',
                'deleted_at' => NULL,
                'id' => 3,
                'logo' => NULL,
                'name' => 'Cristobal Rojas Rojas',
                'payment_data' => NULL,
                'real_name' => '10997824-8',
                'status' => 1,
                'uid' => '10997824-8',
                'unique_hash' => '1269616902103f28d121323c7d269e00',
                'updated_at' => '2020-10-18 21:57:16',
            ),
        ));
        
        
    }
}