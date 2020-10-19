<?php

use Illuminate\Database\Seeder;

class CustomerSegmentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('customer_segments')->delete();
        
        \DB::table('customer_segments')->insert(array (
            0 => 
            array (
                'company_id' => 1,
                'created_at' => '2020-10-18 20:11:48',
                'deleted_at' => NULL,
                'id' => 1,
                'is_user_defined' => 1,
                'name' => 'Principal',
                'status' => 1,
                'updated_at' => '2020-10-18 20:11:48',
            ),
        ));
        
        
    }
}