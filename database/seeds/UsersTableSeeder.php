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
                'email' => 'cristobal223@hotmail.com',
                'email_verified_at' => NULL,
                'id' => 2,
                'name' => 'Cristobal Rojas',
                'password' => '$2y$10$40CGai6JTGBFtoBoGs4kUe5Yg5CV2Qjhf3uxEqwtrC38dkU7mpge.',
                'remember_token' => NULL,
                'updated_at' => '2020-10-18 22:00:26',
            ),
        ));
        
        
    }
}