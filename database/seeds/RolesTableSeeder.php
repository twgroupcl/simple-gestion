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
                'created_at' => '2020-08-22 10:46:38',
                'guard_name' => 'web',
                'id' => 1,
                'name' => 'Super admin',
                'updated_at' => '2020-08-22 10:46:38',
            ),
            1 =>
            array (
                'created_at' => '2020-10-18 20:51:38',
                'guard_name' => 'web',
                'id' => 2,
                'name' => 'Administrador negocio',
                'updated_at' => '2020-10-18 20:51:38',
            ),
            2 =>
            array (
                'created_at' => '2020-10-19 12:43:14',
                'guard_name' => 'web',
                'id' => 3,
                'name' => 'Vendedor marketplace',
                'updated_at' => '2020-10-19 12:43:14',
            ),
        ));


    }
}
