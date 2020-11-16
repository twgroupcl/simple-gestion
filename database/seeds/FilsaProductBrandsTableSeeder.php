<?php

use Illuminate\Database\Seeder;

class FilsaProductBrandsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('product_brands')->delete();
        
        \DB::table('product_brands')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'ALFAGUARA INFANTIL',
                'code' => 'alfanguara-infantil',
                'slug' => 'alfaguara-infantil',
                'image' => NULL,
                'status' => 1,
                'company_id' => 1,
                'created_at' => '2020-11-16 12:19:54',
                'updated_at' => '2020-11-16 12:59:34',
                'deleted_at' => NULL,
                'position' => 0,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'PLAZA & JANES',
                'code' => 'plaza-janes',
                'slug' => 'plaza--janes',
                'image' => NULL,
                'status' => 1,
                'company_id' => 1,
                'created_at' => '2020-11-16 12:23:06',
                'updated_at' => '2020-11-16 12:59:05',
                'deleted_at' => NULL,
                'position' => 0,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'MONTENA',
                'code' => 'montena',
                'slug' => 'montena',
                'image' => NULL,
                'status' => 1,
                'company_id' => 1,
                'created_at' => '2020-11-16 12:23:32',
                'updated_at' => '2020-11-16 12:59:15',
                'deleted_at' => NULL,
                'position' => 0,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'MARTINEZ ROCA',
                'code' => 'martinez-roca',
                'slug' => 'martinez-roca',
                'image' => NULL,
                'status' => 1,
                'company_id' => 1,
                'created_at' => '2020-11-16 12:24:10',
                'updated_at' => '2020-11-16 12:58:51',
                'deleted_at' => NULL,
                'position' => 0,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'BIBLOK',
                'code' => 'biblok',
                'slug' => 'biblok',
                'image' => NULL,
                'status' => 1,
                'company_id' => 1,
                'created_at' => '2020-11-16 12:24:31',
                'updated_at' => '2020-11-16 12:59:20',
                'deleted_at' => NULL,
                'position' => 0,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'DEBOLSILLO',
                'code' => 'debolsillo',
                'slug' => 'debolsillo',
                'image' => NULL,
                'status' => 1,
                'company_id' => 1,
                'created_at' => '2020-11-16 12:25:02',
                'updated_at' => '2020-11-16 12:25:02',
                'deleted_at' => NULL,
                'position' => 0,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'NORMA',
                'code' => 'norma',
                'slug' => 'norma',
                'image' => NULL,
                'status' => 1,
                'company_id' => 1,
                'created_at' => '2020-11-16 12:25:16',
                'updated_at' => '2020-11-16 12:25:16',
                'deleted_at' => NULL,
                'position' => 0,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'ALFAGUARA',
                'code' => 'alfaguara',
                'slug' => 'alfaguara',
                'image' => NULL,
                'status' => 1,
                'company_id' => 1,
                'created_at' => '2020-11-16 12:27:48',
                'updated_at' => '2020-11-16 12:27:48',
                'deleted_at' => NULL,
                'position' => 0,
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'GRIJALBO',
                'code' => 'grijalbo',
                'slug' => 'grijalbo',
                'image' => NULL,
                'status' => 1,
                'company_id' => 1,
                'created_at' => '2020-11-16 12:28:06',
                'updated_at' => '2020-11-16 12:28:06',
                'deleted_at' => NULL,
                'position' => 0,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'SALAMANDRA',
                'code' => 'salamandra',
                'slug' => 'salamandra',
                'image' => NULL,
                'status' => 1,
                'company_id' => 1,
                'created_at' => '2020-11-16 12:28:24',
                'updated_at' => '2020-11-16 12:28:24',
                'deleted_at' => NULL,
                'position' => 0,
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'SUMA',
                'code' => 'suma',
                'slug' => 'suma',
                'image' => NULL,
                'status' => 1,
                'company_id' => 1,
                'created_at' => '2020-11-16 12:28:52',
                'updated_at' => '2020-11-16 12:28:52',
                'deleted_at' => NULL,
                'position' => 0,
            ),
        ));
        
        
    }
}