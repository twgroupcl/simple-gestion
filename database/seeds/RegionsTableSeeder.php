<?php

use Illuminate\Database\Seeder;

class RegionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('regions')->delete();
        
        \DB::table('regions')->insert(array (
            0 => 
            array (
                'country_id' => 43,
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 1,
                'ISO_3166_2_CL' => 'CL-TA',
                'name' => 'Tarapacá',
                'order' => 0,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'country_id' => 43,
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 2,
                'ISO_3166_2_CL' => 'CL-AN',
                'name' => 'Antofagasta',
                'order' => 0,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'country_id' => 43,
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 3,
                'ISO_3166_2_CL' => 'CL-AT',
                'name' => 'Atacama',
                'order' => 0,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'country_id' => 43,
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 4,
                'ISO_3166_2_CL' => 'CL-CO',
                'name' => 'Coquimbo',
                'order' => 0,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'country_id' => 43,
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 5,
                'ISO_3166_2_CL' => 'CL-VS',
                'name' => 'Valparaíso',
                'order' => 0,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'country_id' => 43,
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 6,
                'ISO_3166_2_CL' => 'CL-LI',
                'name' => 'Región del Libertador Gral. Bernardo O’Higgins',
                'order' => 0,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'country_id' => 43,
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 7,
                'ISO_3166_2_CL' => 'CL-ML',
                'name' => 'Región del Maule',
                'order' => 0,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'country_id' => 43,
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 8,
                'ISO_3166_2_CL' => 'CL-BI',
                'name' => 'Región del Biobío',
                'order' => 0,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'country_id' => 43,
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 9,
                'ISO_3166_2_CL' => 'CL-AR',
                'name' => 'Región de la Araucanía',
                'order' => 0,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'country_id' => 43,
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 10,
                'ISO_3166_2_CL' => 'CL-LL',
                'name' => 'Región de Los Lagos',
                'order' => 0,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'country_id' => 43,
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 11,
                'ISO_3166_2_CL' => 'CL-AI',
                'name' => 'Región Aisén del Gral. Carlos Ibáñez del Campo',
                'order' => 0,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'country_id' => 43,
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 12,
                'ISO_3166_2_CL' => 'CL-MA',
                'name' => 'Región de Magallanes y de la Antártica Chilena',
                'order' => 0,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'country_id' => 43,
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 13,
                'ISO_3166_2_CL' => 'CL-RM',
                'name' => 'Región Metropolitana de Santiago',
                'order' => 0,
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'country_id' => 43,
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 14,
                'ISO_3166_2_CL' => 'CL-LR',
                'name' => 'Región de Los Ríos',
                'order' => 0,
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'country_id' => 43,
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 15,
                'ISO_3166_2_CL' => 'CL-AP',
                'name' => 'Arica y Parinacota',
                'order' => 0,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}