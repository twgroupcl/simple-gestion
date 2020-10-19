<?php

use Illuminate\Database\Seeder;

class BranchesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('branches')->delete();
        
        \DB::table('branches')->insert(array (
            0 => 
            array (
                'address' => 'Limache 3421',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 1,
                'name' => 'Sucursal Viña del Mar',
                'status' => 1,
                'unique_hash' => '09d271ea0a82425d38474271229d8208',
                'updated_at' => '2020-08-22 10:46:38',
            ),
            1 => 
            array (
                'address' => 'Recoleta 3421',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 2,
                'name' => 'Sucursal Santiago',
                'status' => 1,
                'unique_hash' => '1e1c18a69fc851069e82e1fbc265bc6d',
                'updated_at' => '2020-08-22 10:46:38',
            ),
            2 => 
            array (
                'address' => 'Hola 44',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 3,
                'name' => 'Sucursal Puerto Montt',
                'status' => 1,
                'unique_hash' => '5fd320d929abd3de0fb1f317a6b71c18',
                'updated_at' => '2020-08-22 10:46:38',
            ),
            3 => 
            array (
                'address' => 'Calle 123',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 4,
                'name' => 'Sucursal Punta Arenas',
                'status' => 1,
                'unique_hash' => 'ed920d0e12d70d38a633d26ee7ceb078',
                'updated_at' => '2020-08-22 10:46:38',
            ),
            4 => 
            array (
                'address' => 'Aconcagua 669, La calera, Valparaíso',
                'created_at' => '2020-10-18 21:58:15',
                'deleted_at' => NULL,
                'id' => 5,
                'name' => 'Aconcagua 669',
                'status' => 1,
                'unique_hash' => 'ed920d0e12d54d38a633d26ee7ceb078',
                'updated_at' => '2020-10-18 21:58:15',
            ),
        ));
        
        
    }
}