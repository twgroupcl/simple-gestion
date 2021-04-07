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
        

        \DB::table('units')->truncate();

        \DB::table('units')->insert(array (
            0 => 
            array (
                'code' => '0',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 1,
            'name' => 'Sin unidad definida',
                'updated_at' => '2020-08-22 10:46:38',
            ),
            1 => 
            array (
                'code' => '1',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 2,
            'name' => 'Unidad 1',
                'updated_at' => '2020-08-22 10:46:38',
            ),
            2 => 
            array (
                'code' => 'BA',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 3,
            'name' => 'Balde',
                'updated_at' => '2020-08-22 10:46:38',
            ),
            3 => 
            array (
                'code' => 'BI',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 4,
            'name' => 'Bidon',
                'updated_at' => '2020-08-22 10:46:38',
            ),
            4 => 
            array (
                'code' => 'BL',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 5,
            'name' => 'Blister',
                'updated_at' => '2020-08-22 10:46:38',
            ),
            5 => 
            array (
                'code' => 'BO',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 6,
            'name' => 'Bolsa',
                'updated_at' => '2020-08-22 10:46:38',
            ),
            6 => 
            array (
                'code' => 'BQ',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 7,
            'name' => 'Bloque',
                'updated_at' => '2020-08-22 10:46:38',
            ),
            7 => 
            array (
                'code' => 'BR',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 8,
            'name' => 'Barra',
                'updated_at' => '2020-08-22 10:46:38',
            ),
            8 => 
            array (
                'code' => 'CA',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 9,
            'name' => 'Caja',
                'updated_at' => '2020-08-22 10:46:38',
            ),
            9 => 
            array (
                'code' => 'CM',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 10,
            'name' => 'Centimetro',
                'updated_at' => '2020-08-22 10:46:38',
            ),
            10 => 
            array (
                'code' => 'CO',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 11,
            'name' => 'Comision',
                'updated_at' => '2020-08-22 10:46:38',
            ),
            11 => 
            array (
                'code' => 'DC',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 12,
            'name' => 'Docena',
                'updated_at' => '2020-08-22 10:46:38',
            ),
            12 => 
            array (
                'code' => 'DI',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 13,
            'name' => 'Display',
                'updated_at' => '2020-08-22 10:46:38',
            ),
            13 => 
            array (
                'code' => 'DO',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 14,
            'name' => 'Dosis',
                'updated_at' => '2020-08-22 10:46:38',
            ),
            14 => 
            array (
                'code' => 'EN',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 15,
            'name' => 'Envase',
                'updated_at' => '2020-08-22 10:46:38',
            ),
            15 => 
            array (
                'code' => 'EQ',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 16,
            'name' => 'Equipo',
                'updated_at' => '2020-08-22 10:46:38',
            ),
            16 => 
            array (
                'code' => 'FR',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 17,
            'name' => 'Frasco',
                'updated_at' => '2020-08-22 10:46:38',
            ),
            17 => 
            array (
                'code' => 'GA',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 18,
            'name' => 'Galon',
                'updated_at' => '2020-08-22 10:46:38',
            ),
            18 => 
            array (
                'code' => 'GR',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 19,
            'name' => 'Gramos',
                'updated_at' => '2020-08-22 10:46:38',
            ),
            19 => 
            array (
                'code' => 'HH',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 20,
            'name' => 'Horas hombre',
                'updated_at' => '2020-08-22 10:46:38',
            ),
            20 => 
            array (
                'code' => 'JE',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 21,
            'name' => 'Jeringa',
                'updated_at' => '2020-08-22 10:46:38',
            ),
            21 => 
            array (
                'code' => 'JU',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 22,
            'name' => 'Juego',
                'updated_at' => '2020-08-22 10:46:38',
            ),
            22 => 
            array (
                'code' => 'KG',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 23,
            'name' => 'Kilos',
                'updated_at' => '2020-08-22 10:46:38',
            ),
            23 => 
            array (
                'code' => 'LT',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 24,
            'name' => 'Litros',
                'updated_at' => '2020-08-22 10:46:38',
            ),
            24 => 
            array (
                'code' => 'M2',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 25,
            'name' => 'Metro cuadrado',
                'updated_at' => '2020-08-22 10:46:38',
            ),
            25 => 
            array (
                'code' => 'M3',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 26,
            'name' => 'Metros cubicos',
                'updated_at' => '2020-08-22 10:46:38',
            ),
            26 => 
            array (
                'code' => 'MT',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 27,
            'name' => 'Metro',
                'updated_at' => '2020-08-22 10:46:38',
            ),
            27 => 
            array (
                'code' => 'PA',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 28,
            'name' => 'Par',
                'updated_at' => '2020-08-22 10:46:38',
            ),
            28 => 
            array (
                'code' => 'PO',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 29,
            'name' => 'Pomo',
                'updated_at' => '2020-08-22 10:46:38',
            ),
            29 => 
            array (
                'code' => 'PT',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 30,
            'name' => 'Pote',
                'updated_at' => '2020-08-22 10:46:38',
            ),
            30 => 
            array (
                'code' => 'PU',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 31,
            'name' => 'Pulgada',
                'updated_at' => '2020-08-22 10:46:38',
            ),
            31 => 
            array (
                'code' => 'RO',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 32,
            'name' => 'Rollo',
                'updated_at' => '2020-08-22 10:46:38',
            ),
            32 => 
            array (
                'code' => 'SA',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 33,
            'name' => 'Saco',
                'updated_at' => '2020-08-22 10:46:38',
            ),
            33 => 
            array (
                'code' => 'SE',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 34,
            'name' => 'Set',
                'updated_at' => '2020-08-22 10:46:38',
            ),
            34 => 
            array (
                'code' => 'SO',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 35,
            'name' => 'Sobre',
                'updated_at' => '2020-08-22 10:46:38',
            ),
            35 => 
            array (
                'code' => 'SP',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 36,
            'name' => 'Spray',
                'updated_at' => '2020-08-22 10:46:38',
            ),
            36 => 
            array (
                'code' => 'SV',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 37,
            'name' => 'Servicios',
                'updated_at' => '2020-08-22 10:46:38',
            ),
            37 => 
            array (
                'code' => 'TA',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 38,
            'name' => 'Tarro',
                'updated_at' => '2020-08-22 10:46:38',
            ),
            38 => 
            array (
                'code' => 'TB',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 39,
            'name' => 'Tableta',
                'updated_at' => '2020-08-22 10:46:38',
            ),
            39 => 
            array (
                'code' => 'TM',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 40,
            'name' => 'Tambor',
                'updated_at' => '2020-08-22 10:46:38',
            ),
            40 => 
            array (
                'code' => 'TN',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 41,
            'name' => 'Tonelada',
                'updated_at' => '2020-08-22 10:46:38',
            ),
            41 => 
            array (
                'code' => 'TU',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 42,
            'name' => 'Tubo',
                'updated_at' => '2020-08-22 10:46:38',
            ),
            42 => 
            array (
                'code' => 'UN',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 43,
            'name' => 'Unidad',
                'updated_at' => '2020-08-22 10:46:38',
            ),
        ));

    }
}