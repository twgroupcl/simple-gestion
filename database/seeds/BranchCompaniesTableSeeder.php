<?php

use Illuminate\Database\Seeder;

class BranchCompaniesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('branch_companies')->delete();

        \DB::table('branch_companies')->insert(array (
            0 =>
            array (
                'branch_id' => 1,
                'company_id' => 1,
                'id' => 1,
            ),
            1 =>
            array (
                'branch_id' => 2,
                'company_id' => 1,
                'id' => 2,
            ),
            2 =>
            array (
                'branch_id' => 3,
                'company_id' => 2,
                'id' => 3,
            ),
            3 =>
            array (
                'branch_id' => 4,
                'company_id' => 2,
                'id' => 4,
            ),
        ));


    }
}
