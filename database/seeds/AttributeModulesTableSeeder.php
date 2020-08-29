<?php

use Illuminate\Database\Seeder;

class AttributeModulesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('attribute_modules')->delete();
        
        \DB::table('attribute_modules')->insert(array (
            0 => 
            array (
                'code' => 'customer',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 1,
                'name' => 'Cliente',
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
        ));
        
        
    }
}