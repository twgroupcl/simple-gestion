<?php

use Illuminate\Database\Seeder;

class FilsaProductClassAttributesTableSeeder extends Seeder
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
                'id' => 1,
                'product_class_id' => 1,
                'json_attributes' => '{"name":"Autor","code":"author","type_attribute":"text"}',
                'json_options' => '[]',
                'validations' => NULL,
                'is_required' => 0,
                'is_configurable' => 0,
                'company_id' => 1,
                'created_at' => '2020-11-16 12:56:21',
                'updated_at' => '2020-11-16 12:56:21',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'product_class_id' => 1,
                'json_attributes' => '{"name":"A\\u00f1o","code":"year","type_attribute":"text"}',
                'json_options' => '[]',
                'validations' => NULL,
                'is_required' => 0,
                'is_configurable' => 0,
                'company_id' => 1,
                'created_at' => '2020-11-16 12:56:34',
                'updated_at' => '2020-11-16 12:56:34',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'product_class_id' => 1,
                'json_attributes' => '{"name":"Idioma","code":"language","type_attribute":"text"}',
                'json_options' => '[]',
                'validations' => NULL,
                'is_required' => 0,
                'is_configurable' => 0,
                'company_id' => 1,
                'created_at' => '2020-11-16 12:56:56',
                'updated_at' => '2020-11-16 12:56:56',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'product_class_id' => 1,
                'json_attributes' => '{"name":"Numero de paginas","code":"pages_number","type_attribute":"text"}',
                'json_options' => '[]',
                'validations' => NULL,
                'is_required' => 0,
                'is_configurable' => 0,
                'company_id' => 1,
                'created_at' => '2020-11-16 12:57:08',
                'updated_at' => '2020-11-16 12:57:08',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'product_class_id' => 1,
                'json_attributes' => '{"name":"Encuadernacion","code":"encuadernacion","type_attribute":"text"}',
                'json_options' => '[]',
                'validations' => NULL,
                'is_required' => 0,
                'is_configurable' => 0,
                'company_id' => 1,
                'created_at' => '2020-11-16 12:57:18',
                'updated_at' => '2020-11-16 12:57:18',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}