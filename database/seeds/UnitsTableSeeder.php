<?php

use Illuminate\Database\Seeder;

class UnitsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('units')->delete();
        
        \DB::table('units')->insert(array (
            0 => 
            array (
                'code' => 'UN',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 1,
            'name' => 'Unidad(es)',
                'updated_at' => '2020-08-22 10:46:38',
            ),
            1 => 
            array (
                'code' => 'lts',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 2,
            'name' => 'Litro(s)',
                'updated_at' => '2020-08-22 10:46:38',
            ),
            2 => 
            array (
                'code' => 'kg',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 3,
            'name' => 'Kilo(s)',
                'updated_at' => '2020-08-22 10:46:38',
            ),
        ));
        
        
    }
}