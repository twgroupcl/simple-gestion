<?php

use Illuminate\Database\Seeder;

class BranchUserTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('branch_user')->delete();
        
        \DB::table('branch_user')->insert(array (
            0 => 
            array (
                'branch_id' => 1,
                'created_at' => NULL,
                'id' => 1,
                'is_default' => 1,
                'updated_at' => NULL,
                'user_id' => 1,
            ),
            1 => 
            array (
                'branch_id' => 2,
                'created_at' => NULL,
                'id' => 2,
                'is_default' => 0,
                'updated_at' => NULL,
                'user_id' => 1,
            ),
        ));
        
        
    }
}