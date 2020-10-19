<?php

use Illuminate\Database\Seeder;

class AttributesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('attributes')->delete();

        \DB::table('attributes')->insert(array (
            0 =>
            array (
                'admin_name' => '¿Dónde nos conoció?',
                'code' => 'txt',
                'company_id' => 1,
                'created_at' => '2020-08-22 09:57:55',
                'deleted_at' => NULL,
                'field_id' => 50,
                'id' => 1,
                'is_configurable' => 1,
                'is_filterable' => 1,
                'is_required' => 1,
                'is_unique' => 1,
                'is_user_defined' => 1,
                'is_visible_on_front' => 1,
                'library' => NULL,
                'options' => NULL,
                'position' => 0,
                'script' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 09:57:55',
                'validation' => NULL,
            ),
        ));


    }
}
