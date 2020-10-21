<?php

use Illuminate\Database\Seeder;

class ProductClassAttributesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('product_class_attributes')->delete();
        
        \DB::table('product_class_attributes')->insert(array (
            0 => 
            array (
                'company_id' => 1,
                'created_at' => '2020-10-21 13:55:18',
                'deleted_at' => NULL,
                'id' => 1,
                'is_configurable' => 0,
                'is_required' => 0,
                'json_attributes' => '{"name":"tala","type_attribute":"text"}',
                'json_options' => '[]',
                'product_class_id' => 1,
                'updated_at' => '2020-10-21 13:55:18',
                'validations' => NULL,
            ),
        ));
        
        
    }
}