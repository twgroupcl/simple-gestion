<?php

use Illuminate\Database\Seeder;

class AttributeFamiliesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('attribute_families')->delete();
        
        \DB::table('attribute_families')->insert(array (
            0 => 
            array (
                'attribute_module_id' => 1,
                'code' => 'customer',
                'company_id' => 1,
                'created_at' => '2020-08-22 10:46:38',
                'id' => 1,
                'is_user_defined' => 1,
                'name' => 'Cliente',
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
        ));
        
        
    }
}