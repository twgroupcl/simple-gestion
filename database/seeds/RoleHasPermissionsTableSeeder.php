<?php

use Illuminate\Database\Seeder;

class RoleHasPermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('role_has_permissions')->delete();
        
        \DB::table('role_has_permissions')->insert(array (
            0 => 
            array (
                'permission_id' => 1,
                'role_id' => 2,
            ),
            1 => 
            array (
                'permission_id' => 2,
                'role_id' => 2,
            ),
            2 => 
            array (
                'permission_id' => 3,
                'role_id' => 2,
            ),
            3 => 
            array (
                'permission_id' => 4,
                'role_id' => 2,
            ),
            4 => 
            array (
                'permission_id' => 5,
                'role_id' => 2,
            ),
            5 => 
            array (
                'permission_id' => 6,
                'role_id' => 2,
            ),
            6 => 
            array (
                'permission_id' => 7,
                'role_id' => 2,
            ),
            7 => 
            array (
                'permission_id' => 8,
                'role_id' => 2,
            ),
            8 => 
            array (
                'permission_id' => 17,
                'role_id' => 2,
            ),
            9 => 
            array (
                'permission_id' => 18,
                'role_id' => 2,
            ),
            10 => 
            array (
                'permission_id' => 19,
                'role_id' => 2,
            ),
            11 => 
            array (
                'permission_id' => 20,
                'role_id' => 2,
            ),
            12 => 
            array (
                'permission_id' => 21,
                'role_id' => 2,
            ),
            13 => 
            array (
                'permission_id' => 22,
                'role_id' => 2,
            ),
            14 => 
            array (
                'permission_id' => 23,
                'role_id' => 2,
            ),
            15 => 
            array (
                'permission_id' => 24,
                'role_id' => 2,
            ),
            16 => 
            array (
                'permission_id' => 25,
                'role_id' => 2,
            ),
            17 => 
            array (
                'permission_id' => 26,
                'role_id' => 2,
            ),
            18 => 
            array (
                'permission_id' => 27,
                'role_id' => 2,
            ),
            19 => 
            array (
                'permission_id' => 28,
                'role_id' => 2,
            ),
            20 => 
            array (
                'permission_id' => 29,
                'role_id' => 2,
            ),
            21 => 
            array (
                'permission_id' => 30,
                'role_id' => 2,
            ),
            22 => 
            array (
                'permission_id' => 31,
                'role_id' => 2,
            ),
            23 => 
            array (
                'permission_id' => 32,
                'role_id' => 2,
            ),
            24 => 
            array (
                'permission_id' => 33,
                'role_id' => 2,
            ),
            25 => 
            array (
                'permission_id' => 34,
                'role_id' => 2,
            ),
            26 => 
            array (
                'permission_id' => 35,
                'role_id' => 2,
            ),
            27 => 
            array (
                'permission_id' => 36,
                'role_id' => 2,
            ),
            28 => 
            array (
                'permission_id' => 37,
                'role_id' => 2,
            ),
            29 => 
            array (
                'permission_id' => 38,
                'role_id' => 2,
            ),
            30 => 
            array (
                'permission_id' => 39,
                'role_id' => 2,
            ),
            31 => 
            array (
                'permission_id' => 40,
                'role_id' => 2,
            ),
            32 => 
            array (
                'permission_id' => 17,
                'role_id' => 3,
            ),
            33 => 
            array (
                'permission_id' => 18,
                'role_id' => 3,
            ),
            34 => 
            array (
                'permission_id' => 19,
                'role_id' => 3,
            ),
            35 => 
            array (
                'permission_id' => 20,
                'role_id' => 3,
            ),
        ));
        
        
    }
}