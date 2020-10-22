<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Super admin',
                'guard_name' => 'web',
                'created_at' => '2020-08-22 10:46:38',
                'updated_at' => '2020-08-22 10:46:38',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Administrador negocio',
                'guard_name' => 'web',
                'created_at' => '2020-10-18 20:51:38',
                'updated_at' => '2020-10-18 20:51:38',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Vendedor marketplace',
                'guard_name' => 'web',
                'created_at' => '2020-10-19 12:43:14',
                'updated_at' => '2020-10-19 12:43:14',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Cliente Marketplace',
                'guard_name' => 'web',
                'created_at' => '2020-10-22 13:09:34',
                'updated_at' => '2020-10-22 13:09:34',
            ),
        ));
        
        
    }
}