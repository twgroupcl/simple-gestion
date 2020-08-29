<?php

use Illuminate\Database\Seeder;

class ProvincesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('provinces')->delete();
        
        \DB::table('provinces')->insert(array (
            0 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 1,
                'name' => 'Arica',
                'order' => 0,
                'region_id' => 15,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 2,
                'name' => 'Parinacota',
                'order' => 0,
                'region_id' => 15,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 3,
                'name' => 'Iquique',
                'order' => 0,
                'region_id' => 1,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 4,
                'name' => 'Tamarugal',
                'order' => 0,
                'region_id' => 1,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 5,
                'name' => 'Antofagasta',
                'order' => 0,
                'region_id' => 2,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 6,
                'name' => 'El Loa',
                'order' => 0,
                'region_id' => 2,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 7,
                'name' => 'Tocopilla',
                'order' => 0,
                'region_id' => 2,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 8,
                'name' => 'Copiapó',
                'order' => 0,
                'region_id' => 3,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 9,
                'name' => 'Chañaral',
                'order' => 0,
                'region_id' => 3,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 10,
                'name' => 'Huasco',
                'order' => 0,
                'region_id' => 3,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 11,
                'name' => 'Elqui',
                'order' => 0,
                'region_id' => 4,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 12,
                'name' => 'Choapa',
                'order' => 0,
                'region_id' => 4,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 13,
                'name' => 'Limarí',
                'order' => 0,
                'region_id' => 4,
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 14,
                'name' => 'Valparaíso',
                'order' => 0,
                'region_id' => 5,
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 15,
                'name' => 'Isla de Pascua',
                'order' => 0,
                'region_id' => 5,
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 16,
                'name' => 'Los Andes',
                'order' => 0,
                'region_id' => 5,
                'updated_at' => NULL,
            ),
            16 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 17,
                'name' => 'Petorca',
                'order' => 0,
                'region_id' => 5,
                'updated_at' => NULL,
            ),
            17 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 18,
                'name' => 'Quillota',
                'order' => 0,
                'region_id' => 5,
                'updated_at' => NULL,
            ),
            18 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 19,
                'name' => 'San Antonio',
                'order' => 0,
                'region_id' => 5,
                'updated_at' => NULL,
            ),
            19 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 20,
                'name' => 'San Felipe de Aconcagua',
                'order' => 0,
                'region_id' => 5,
                'updated_at' => NULL,
            ),
            20 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 21,
                'name' => 'Marga Marga',
                'order' => 0,
                'region_id' => 5,
                'updated_at' => NULL,
            ),
            21 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 22,
                'name' => 'Cachapoal',
                'order' => 0,
                'region_id' => 6,
                'updated_at' => NULL,
            ),
            22 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 23,
                'name' => 'Cardenal Caro',
                'order' => 0,
                'region_id' => 6,
                'updated_at' => NULL,
            ),
            23 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 24,
                'name' => 'Colchagua',
                'order' => 0,
                'region_id' => 6,
                'updated_at' => NULL,
            ),
            24 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 25,
                'name' => 'Talca',
                'order' => 0,
                'region_id' => 7,
                'updated_at' => NULL,
            ),
            25 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 26,
                'name' => 'Cauquenes',
                'order' => 0,
                'region_id' => 7,
                'updated_at' => NULL,
            ),
            26 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 27,
                'name' => 'Curicó',
                'order' => 0,
                'region_id' => 7,
                'updated_at' => NULL,
            ),
            27 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 28,
                'name' => 'Linares',
                'order' => 0,
                'region_id' => 7,
                'updated_at' => NULL,
            ),
            28 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 29,
                'name' => 'Concepción',
                'order' => 0,
                'region_id' => 8,
                'updated_at' => NULL,
            ),
            29 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 30,
                'name' => 'Arauco',
                'order' => 0,
                'region_id' => 8,
                'updated_at' => NULL,
            ),
            30 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 31,
                'name' => 'Biobío',
                'order' => 0,
                'region_id' => 8,
                'updated_at' => NULL,
            ),
            31 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 32,
                'name' => 'Ñuble',
                'order' => 0,
                'region_id' => 8,
                'updated_at' => NULL,
            ),
            32 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 33,
                'name' => 'Cautín',
                'order' => 0,
                'region_id' => 9,
                'updated_at' => NULL,
            ),
            33 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 34,
                'name' => 'Malleco',
                'order' => 0,
                'region_id' => 9,
                'updated_at' => NULL,
            ),
            34 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 35,
                'name' => 'Valdivia',
                'order' => 0,
                'region_id' => 14,
                'updated_at' => NULL,
            ),
            35 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 36,
                'name' => 'Ranco',
                'order' => 0,
                'region_id' => 14,
                'updated_at' => NULL,
            ),
            36 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 37,
                'name' => 'Llanquihue',
                'order' => 0,
                'region_id' => 10,
                'updated_at' => NULL,
            ),
            37 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 38,
                'name' => 'Chiloé',
                'order' => 0,
                'region_id' => 10,
                'updated_at' => NULL,
            ),
            38 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 39,
                'name' => 'Osorno',
                'order' => 0,
                'region_id' => 10,
                'updated_at' => NULL,
            ),
            39 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 40,
                'name' => 'Palena',
                'order' => 0,
                'region_id' => 10,
                'updated_at' => NULL,
            ),
            40 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 41,
                'name' => 'Coihaique',
                'order' => 0,
                'region_id' => 11,
                'updated_at' => NULL,
            ),
            41 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 42,
                'name' => 'Aisén',
                'order' => 0,
                'region_id' => 11,
                'updated_at' => NULL,
            ),
            42 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 43,
                'name' => 'Capitán Prat',
                'order' => 0,
                'region_id' => 11,
                'updated_at' => NULL,
            ),
            43 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 44,
                'name' => 'General Carrera',
                'order' => 0,
                'region_id' => 11,
                'updated_at' => NULL,
            ),
            44 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 45,
                'name' => 'Magallanes',
                'order' => 0,
                'region_id' => 12,
                'updated_at' => NULL,
            ),
            45 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 46,
                'name' => 'Antártica Chilena',
                'order' => 0,
                'region_id' => 12,
                'updated_at' => NULL,
            ),
            46 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 47,
                'name' => 'Tierra del Fuego',
                'order' => 0,
                'region_id' => 12,
                'updated_at' => NULL,
            ),
            47 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 48,
                'name' => 'Última Esperanza',
                'order' => 0,
                'region_id' => 12,
                'updated_at' => NULL,
            ),
            48 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 49,
                'name' => 'Santiago',
                'order' => 0,
                'region_id' => 13,
                'updated_at' => NULL,
            ),
            49 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 50,
                'name' => 'Cordillera',
                'order' => 0,
                'region_id' => 13,
                'updated_at' => NULL,
            ),
            50 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 51,
                'name' => 'Chacabuco',
                'order' => 0,
                'region_id' => 13,
                'updated_at' => NULL,
            ),
            51 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 52,
                'name' => 'Maipo',
                'order' => 0,
                'region_id' => 13,
                'updated_at' => NULL,
            ),
            52 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 53,
                'name' => 'Melipilla',
                'order' => 0,
                'region_id' => 13,
                'updated_at' => NULL,
            ),
            53 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 54,
                'name' => 'Talagante',
                'order' => 0,
                'region_id' => 13,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}