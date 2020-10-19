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
            8 => 
            array (
                'created_at' => '2020-10-19 12:43:34',
                'guard_name' => 'web',
                'id' => 9,
                'name' => 'seller.list',
                'updated_at' => '2020-10-19 12:43:34',
            ),
            9 => 
            array (
                'created_at' => '2020-10-19 12:43:40',
                'guard_name' => 'web',
                'id' => 10,
                'name' => 'seller.create',
                'updated_at' => '2020-10-19 12:43:40',
            ),
            10 => 
            array (
                'created_at' => '2020-10-19 12:43:47',
                'guard_name' => 'web',
                'id' => 11,
                'name' => 'seller.update',
                'updated_at' => '2020-10-19 12:43:47',
            ),
            11 => 
            array (
                'created_at' => '2020-10-19 12:43:53',
                'guard_name' => 'web',
                'id' => 12,
                'name' => 'seller.delete',
                'updated_at' => '2020-10-19 12:43:53',
            ),
            12 => 
            array (
                'created_at' => '2020-10-19 12:44:04',
                'guard_name' => 'web',
                'id' => 13,
                'name' => 'sellercategory.list',
                'updated_at' => '2020-10-19 12:44:04',
            ),
            13 => 
            array (
                'created_at' => '2020-10-19 12:44:10',
                'guard_name' => 'web',
                'id' => 14,
                'name' => 'sellercategory.create',
                'updated_at' => '2020-10-19 12:44:10',
            ),
            14 => 
            array (
                'created_at' => '2020-10-19 12:44:17',
                'guard_name' => 'web',
                'id' => 15,
                'name' => 'sellercategory.update',
                'updated_at' => '2020-10-19 12:44:17',
            ),
            15 => 
            array (
                'created_at' => '2020-10-19 12:44:24',
                'guard_name' => 'web',
                'id' => 16,
                'name' => 'sellercategory.delete',
                'updated_at' => '2020-10-19 12:44:24',
            ),
            16 => 
            array (
                'created_at' => '2020-10-19 12:45:13',
                'guard_name' => 'web',
                'id' => 17,
                'name' => 'product.list',
                'updated_at' => '2020-10-19 12:45:13',
            ),
            17 => 
            array (
                'created_at' => '2020-10-19 12:45:19',
                'guard_name' => 'web',
                'id' => 18,
                'name' => 'product.create',
                'updated_at' => '2020-10-19 12:45:19',
            ),
            18 => 
            array (
                'created_at' => '2020-10-19 12:45:25',
                'guard_name' => 'web',
                'id' => 19,
                'name' => 'product.update',
                'updated_at' => '2020-10-19 12:45:25',
            ),
            19 => 
            array (
                'created_at' => '2020-10-19 12:45:31',
                'guard_name' => 'web',
                'id' => 20,
                'name' => 'product.delete',
                'updated_at' => '2020-10-19 12:45:31',
            ),
            20 => 
            array (
                'created_at' => '2020-10-19 12:46:13',
                'guard_name' => 'web',
                'id' => 21,
                'name' => 'productbrand.list',
                'updated_at' => '2020-10-19 12:46:13',
            ),
            21 => 
            array (
                'created_at' => '2020-10-19 12:46:18',
                'guard_name' => 'web',
                'id' => 22,
                'name' => 'productbrand.create',
                'updated_at' => '2020-10-19 12:46:18',
            ),
            22 => 
            array (
                'created_at' => '2020-10-19 12:46:24',
                'guard_name' => 'web',
                'id' => 23,
                'name' => 'productbrand.update',
                'updated_at' => '2020-10-19 12:46:24',
            ),
            23 => 
            array (
                'created_at' => '2020-10-19 12:46:30',
                'guard_name' => 'web',
                'id' => 24,
                'name' => 'productbrand.delete',
                'updated_at' => '2020-10-19 12:46:30',
            ),
            24 => 
            array (
                'created_at' => '2020-10-19 12:46:39',
                'guard_name' => 'web',
                'id' => 25,
                'name' => 'productcategory.list',
                'updated_at' => '2020-10-19 12:46:39',
            ),
            25 => 
            array (
                'created_at' => '2020-10-19 12:46:46',
                'guard_name' => 'web',
                'id' => 26,
                'name' => 'productcategory.create',
                'updated_at' => '2020-10-19 12:46:46',
            ),
            26 => 
            array (
                'created_at' => '2020-10-19 12:46:55',
                'guard_name' => 'web',
                'id' => 27,
                'name' => 'productcategory.update',
                'updated_at' => '2020-10-19 12:46:55',
            ),
            27 => 
            array (
                'created_at' => '2020-10-19 12:47:01',
                'guard_name' => 'web',
                'id' => 28,
                'name' => 'productcategory.delete',
                'updated_at' => '2020-10-19 12:47:01',
            ),
            28 => 
            array (
                'created_at' => '2020-10-19 12:47:11',
                'guard_name' => 'web',
                'id' => 29,
                'name' => 'productclass.list',
                'updated_at' => '2020-10-19 12:47:11',
            ),
            29 => 
            array (
                'created_at' => '2020-10-19 12:47:16',
                'guard_name' => 'web',
                'id' => 30,
                'name' => 'productclass.create',
                'updated_at' => '2020-10-19 12:47:16',
            ),
            30 => 
            array (
                'created_at' => '2020-10-19 12:47:22',
                'guard_name' => 'web',
                'id' => 31,
                'name' => 'productclass.update',
                'updated_at' => '2020-10-19 12:47:22',
            ),
            31 => 
            array (
                'created_at' => '2020-10-19 12:47:31',
                'guard_name' => 'web',
                'id' => 32,
                'name' => 'productclass.delete',
                'updated_at' => '2020-10-19 12:47:31',
            ),
            32 => 
            array (
                'created_at' => '2020-10-19 12:47:38',
                'guard_name' => 'web',
                'id' => 33,
                'name' => 'productclassattribute.list',
                'updated_at' => '2020-10-19 12:47:38',
            ),
            33 => 
            array (
                'created_at' => '2020-10-19 12:47:44',
                'guard_name' => 'web',
                'id' => 34,
                'name' => 'productclassattribute.create',
                'updated_at' => '2020-10-19 12:47:44',
            ),
            34 => 
            array (
                'created_at' => '2020-10-19 12:47:50',
                'guard_name' => 'web',
                'id' => 35,
                'name' => 'productclassattribute.update',
                'updated_at' => '2020-10-19 12:47:50',
            ),
            35 => 
            array (
                'created_at' => '2020-10-19 12:47:57',
                'guard_name' => 'web',
                'id' => 36,
                'name' => 'productclassattribute.delete',
                'updated_at' => '2020-10-19 12:47:57',
            ),
            36 => 
            array (
                'created_at' => '2020-10-19 12:48:06',
                'guard_name' => 'web',
                'id' => 37,
                'name' => 'productinventorysource.list',
                'updated_at' => '2020-10-19 12:48:06',
            ),
            37 => 
            array (
                'created_at' => '2020-10-19 12:48:13',
                'guard_name' => 'web',
                'id' => 38,
                'name' => 'productinventorysource.create',
                'updated_at' => '2020-10-19 12:48:13',
            ),
            38 => 
            array (
                'created_at' => '2020-10-19 12:48:19',
                'guard_name' => 'web',
                'id' => 39,
                'name' => 'productinventorysource.update',
                'updated_at' => '2020-10-19 12:48:19',
            ),
            39 => 
            array (
                'created_at' => '2020-10-19 12:48:25',
                'guard_name' => 'web',
                'id' => 40,
                'name' => 'productinventorysource.delete',
                'updated_at' => '2020-10-19 12:48:25',
            ),
        ));
        
        
    }
}