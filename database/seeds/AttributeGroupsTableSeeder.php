<?php

use Illuminate\Database\Seeder;

class AttributeGroupsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('attribute_groups')->delete();
        
        \DB::table('attribute_groups')->insert(array (
            0 => 
            array (
                'attribute_family_id' => 1,
                'id' => 1,
                'is_tab' => 0,
                'is_user_defined' => 1,
                'name' => 'others',
                'position' => 0,
            ),
        ));
        
        
    }
}