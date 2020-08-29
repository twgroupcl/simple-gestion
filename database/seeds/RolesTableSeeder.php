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
        ));
        
        
    }
}