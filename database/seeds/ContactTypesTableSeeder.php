<?php

use Illuminate\Database\Seeder;

class ContactTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('contact_types')->delete();
        
        \DB::table('contact_types')->insert(array (
            0 => 
            array (
                'code' => '01',
                'created_at' => '2020-10-18 20:23:11',
                'id' => 1,
                'name' => 'Web',
                'updated_at' => '2020-10-18 20:23:11',
            ),
            1 => 
            array (
                'code' => '02',
                'created_at' => '2020-10-18 20:23:20',
                'id' => 2,
                'name' => 'Facebook',
                'updated_at' => '2020-10-18 20:23:20',
            ),
            2 => 
            array (
                'code' => '03',
                'created_at' => '2020-10-18 20:23:30',
                'id' => 3,
                'name' => 'Instagram',
                'updated_at' => '2020-10-18 20:23:30',
            ),
        ));
        
        
    }
}