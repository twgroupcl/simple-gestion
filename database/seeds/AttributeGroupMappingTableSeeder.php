<?php

use Illuminate\Database\Seeder;

class AttributeGroupMappingTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('attribute_group_mapping')->delete();
        
        \DB::table('attribute_group_mapping')->insert(array (
            0 => 
            array (
                'attribute_group_id' => 1,
                'attribute_id' => 1,
                'position' => 0,
            ),
        ));
        
        
    }
}