<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'created_at' => '2020-08-22 10:46:38',
                'email' => 'super@twgroup.cl',
                'email_verified_at' => NULL,
                'id' => 1,
                'name' => 'Super',
                'password' => '$2y$10$IpB0cCm9nVjJshyeuODD8.lKmHdoLVEWsgq2LxAeQ5Rjm/VWr9oMe',
                'remember_token' => NULL,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            1 => 
            array (
                'created_at' => '2020-10-18 22:00:26',
                'email' => 'negocio@twgroup.cl',
                'email_verified_at' => NULL,
                'id' => 2,
                'name' => 'Negocio',
                'password' => '$2y$10$oKPMQ7Ma90sHB4L/iqdo.u77AJKOphLogJJ14H7kgGEy6hajyAYfG',
                'remember_token' => NULL,
                'updated_at' => '2020-10-19 12:53:19',
            ),
            2 => 
            array (
                'created_at' => '2020-10-19 12:52:23',
                'email' => 'vendedor@twgroup.cl',
                'email_verified_at' => NULL,
                'id' => 3,
                'name' => 'Vendedor',
                'password' => '$2y$10$IJV6UouAYNQpvLEbIUQl4O81qNcmEzzERAXzPIz8PYQcqD4GOzQzK',
                'remember_token' => NULL,
                'updated_at' => '2020-10-19 12:52:23',
            ),
        ));
        
        
    }
}