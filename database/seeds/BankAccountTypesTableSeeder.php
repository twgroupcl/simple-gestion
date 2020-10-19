<?php

use Illuminate\Database\Seeder;

class BankAccountTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('bank_account_types')->delete();
        
        \DB::table('bank_account_types')->insert(array (
            0 => 
            array (
                'code' => 'cc-01',
                'created_at' => '2020-10-18 20:21:07',
                'id' => 1,
                'name' => 'Cuenta corriente',
                'updated_at' => '2020-10-18 20:21:07',
            ),
            1 => 
            array (
                'code' => 'ca-02',
                'created_at' => '2020-10-18 20:21:49',
                'id' => 2,
                'name' => 'Cuenta ahorro',
                'updated_at' => '2020-10-18 20:21:49',
            ),
            2 => 
            array (
                'code' => 'cv-03',
                'created_at' => '2020-10-18 20:22:05',
                'id' => 3,
                'name' => 'Cuenta cista',
                'updated_at' => '2020-10-18 20:22:05',
            ),
            3 => 
            array (
                'code' => 'ce-04',
                'created_at' => '2020-10-18 20:22:24',
                'id' => 4,
                'name' => 'Chequera electrónica',
                'updated_at' => '2020-10-18 20:22:24',
            ),
            4 => 
            array (
                'code' => 'cr-05',
                'created_at' => '2020-10-18 20:22:40',
                'id' => 5,
                'name' => 'Cuenta rut',
                'updated_at' => '2020-10-18 20:22:40',
            ),
        ));
        
        
    }
}