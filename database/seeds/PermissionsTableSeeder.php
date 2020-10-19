<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('permissions')->delete();

        \DB::table('permissions')->insert(array (
            0 =>
            array (
                'created_at' => '2020-10-18 20:53:29',
                'guard_name' => 'web',
                'id' => 1,
                'name' => 'customer.list',
                'updated_at' => '2020-10-18 20:53:29',
            ),
            1 =>
            array (
                'created_at' => '2020-10-18 20:53:40',
                'guard_name' => 'web',
                'id' => 2,
                'name' => 'customer.create',
                'updated_at' => '2020-10-18 20:53:40',
            ),
            2 =>
            array (
                'created_at' => '2020-10-18 20:53:49',
                'guard_name' => 'web',
                'id' => 3,
                'name' => 'customer.update',
                'updated_at' => '2020-10-18 20:53:49',
            ),
            3 =>
            array (
                'created_at' => '2020-10-18 20:53:58',
                'guard_name' => 'web',
                'id' => 4,
                'name' => 'customer.delete',
                'updated_at' => '2020-10-18 20:53:58',
            ),
            4 =>
            array (
                'created_at' => '2020-10-18 21:29:21',
                'guard_name' => 'web',
                'id' => 5,
                'name' => 'customersegment.list',
                'updated_at' => '2020-10-18 21:29:21',
            ),
            5 =>
            array (
                'created_at' => '2020-10-18 21:29:38',
                'guard_name' => 'web',
                'id' => 6,
                'name' => 'customersegment.create',
                'updated_at' => '2020-10-18 21:29:38',
            ),
            6 =>
            array (
                'created_at' => '2020-10-18 21:29:46',
                'guard_name' => 'web',
                'id' => 7,
                'name' => 'customersegment.update',
                'updated_at' => '2020-10-18 21:29:46',
            ),
            7 =>
            array (
                'created_at' => '2020-10-18 21:29:57',
                'guard_name' => 'web',
                'id' => 8,
                'name' => 'customersegment.delete',
                'updated_at' => '2020-10-18 21:29:57',
            ),
        ));


    }
}
