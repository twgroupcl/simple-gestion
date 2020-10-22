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

                'id' => 1,
                'product_class_id' => 1,
                'json_attributes' => '{"name":"Tipo de garantia","type_attribute":"text"}',
                'json_options' => '[]',
                'validations' => NULL,
                'is_required' => 0,
                'is_configurable' => 0,
                'created_at' => '2020-10-14 17:24:17',
                'updated_at' => '2020-10-14 17:24:17',
                'company_id' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'product_class_id' => 1,
                'json_attributes' => '{"name":"Estado del producto","type_attribute":"select"}',
                'json_options' => '[{"option_name":"Nuevo"},{"option_name":"Usado"},{"option_name":"Como nuevo"}]',
                'validations' => NULL,
                'is_required' => 0,
                'is_configurable' => 0,
                'created_at' => '2020-10-14 17:25:26',
                'updated_at' => '2020-10-14 17:25:26',
                'company_id' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'product_class_id' => 2,
                'json_attributes' => '{"name":"Talla","type_attribute":"select"}',
                'json_options' => '[{"option_name":"XS"},{"option_name":"S"},{"option_name":"M"},{"option_name":"L"},{"option_name":"XL"}]',
                'validations' => NULL,
                'is_required' => 0,
                'is_configurable' => 1,
                'created_at' => '2020-10-14 17:26:23',
                'updated_at' => '2020-10-14 17:26:23',
                'company_id' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'product_class_id' => 2,
                'json_attributes' => '{"name":"Color","type_attribute":"select"}',
                'json_options' => '[{"option_name":"Negro"},{"option_name":"Blanco"},{"option_name":"Azul"},{"option_name":"Rojo"},{"option_name":"Amarillo"},{"option_name":"Verde"},{"option_name":"Gris"}]',
                'validations' => NULL,
                'is_required' => 0,
                'is_configurable' => 1,
                'created_at' => '2020-10-14 17:27:15',
                'updated_at' => '2020-10-14 17:27:15',
                'company_id' => 1,
            ),
            4 => 
            array (
                'id' => 5,
                'product_class_id' => 3,
                'json_attributes' => '{"name":"Sistema Operativo","type_attribute":"select"}',
                'json_options' => '[{"option_name":"Windows"},{"option_name":"MacOS"},{"option_name":"Linux"}]',
                'validations' => NULL,
                'is_required' => 0,
                'is_configurable' => 1,
                'created_at' => '2020-10-14 17:27:36',
                'company_id' => 1,
                'updated_at' => '2020-10-14 17:27:36',
            ),
            5 => 
            array (
                'id' => 6,
                'product_class_id' => 3,
                'json_attributes' => '{"name":"Capacidad de disco duro","type_attribute":"text"}',
                'json_options' => '[]',
                'validations' => NULL,
                'is_required' => 0,
                'is_configurable' => 0,
                'created_at' => '2020-10-14 17:27:54',
                'updated_at' => '2020-10-14 17:27:54',
                'company_id' => 1,

            ),
        ));
        
        
    }
}