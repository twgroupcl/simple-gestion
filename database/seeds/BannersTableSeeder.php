<?php

use Illuminate\Database\Seeder;

class BannersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('banners')->delete();
        \DB::table('banners')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name'       => 'Banner 1',
                'path_web'   => '',
                'path_mobile' => '',
                'section'    => 1,
                'created_at' => '2020-11-24 20:24:06',
                'updated_at' => '2020-11-24 20:24:06',
            ),
            1 => 
            array (
                'id' => 2,
                'name'       => 'Banner 2',
                'path_web'   => '',
                'path_mobile' => '',
                'section'    => 2,
                'created_at' => '2020-11-24 20:24:06',
                'updated_at' => '2020-11-24 20:24:06',
            ),
            2 => 
            array (
                'id' => 3,
                'name'       => 'Banner 3',
                'path_web'   => '',
                'path_mobile' => '',
                'section'    => 3,
                'created_at' => '2020-11-24 20:24:06',
                'updated_at' => '2020-11-24 20:24:06',
            ),
            3 => 
            array (
                'id' => 4,
                'name'       => 'Banner 4',
                'path_web'   => '',
                'path_mobile' => '',
                'section'    => 4,
                'created_at' => '2020-11-24 20:24:06',
                'updated_at' => '2020-11-24 20:24:06',
            ),
        ));        
    }
}
