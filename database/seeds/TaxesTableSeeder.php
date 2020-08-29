<?php

use Illuminate\Database\Seeder;

class TaxesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('taxes')->delete();
        
        \DB::table('taxes')->insert(array (
            0 => 
            array (
                'amount' => 15.0,
                'code' => 23,
                'country_id' => 43,
                'created_at' => '2020-08-22 10:46:36',
                'deleted_at' => NULL,
                'id' => 1,
                'name' => 'Joyas y Piedras',
                'type' => '%',
                'updated_at' => '2020-08-22 10:46:36',
            ),
            1 => 
            array (
                'amount' => 31.5,
                'code' => 24,
                'country_id' => 43,
                'created_at' => '2020-08-22 10:46:36',
                'deleted_at' => NULL,
                'id' => 2,
                'name' => 'Licores y destilados',
                'type' => '%',
                'updated_at' => '2020-08-22 10:46:36',
            ),
            2 => 
            array (
                'amount' => 20.5,
                'code' => 25,
                'country_id' => 43,
                'created_at' => '2020-08-22 10:46:36',
                'deleted_at' => NULL,
                'id' => 3,
                'name' => 'Vinos',
                'type' => '%',
                'updated_at' => '2020-08-22 10:46:36',
            ),
            3 => 
            array (
                'amount' => 20.5,
                'code' => 26,
                'country_id' => 43,
                'created_at' => '2020-08-22 10:46:36',
                'deleted_at' => NULL,
                'id' => 4,
                'name' => 'Cervezas',
                'type' => '%',
                'updated_at' => '2020-08-22 10:46:36',
            ),
            4 => 
            array (
                'amount' => 10.0,
                'code' => 27,
                'country_id' => 43,
                'created_at' => '2020-08-22 10:46:36',
                'deleted_at' => NULL,
                'id' => 5,
                'name' => 'Bebidas y minerales',
                'type' => '%',
                'updated_at' => '2020-08-22 10:46:36',
            ),
            5 => 
            array (
                'amount' => 15.0,
                'code' => 44,
                'country_id' => 43,
                'created_at' => '2020-08-22 10:46:36',
                'deleted_at' => NULL,
                'id' => 6,
                'name' => 'Caviar y tapices',
                'type' => '%',
                'updated_at' => '2020-08-22 10:46:36',
            ),
            6 => 
            array (
                'amount' => 50.0,
                'code' => 45,
                'country_id' => 43,
                'created_at' => '2020-08-22 10:46:36',
                'deleted_at' => NULL,
                'id' => 7,
                'name' => 'Pirotecnia',
                'type' => '%',
                'updated_at' => '2020-08-22 10:46:36',
            ),
            7 => 
            array (
                'amount' => 18.0,
                'code' => 271,
                'country_id' => 43,
                'created_at' => '2020-08-22 10:46:36',
                'deleted_at' => NULL,
                'id' => 8,
                'name' => 'Bebidas azucaradas',
                'type' => '%',
                'updated_at' => '2020-08-22 10:46:36',
            ),
        ));
        
        
    }
}