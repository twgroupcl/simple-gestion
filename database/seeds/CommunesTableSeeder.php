<?php

use Illuminate\Database\Seeder;

class CommunesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('communes')->delete();
        
        \DB::table('communes')->insert(array (
            0 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 1,
                'name' => 'Iquique',
                'order' => 0,
                'province_id' => 3,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 2,
                'name' => 'Alto Hospicio',
                'order' => 0,
                'province_id' => 3,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 3,
                'name' => 'Pozo Almonte',
                'order' => 0,
                'province_id' => 4,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 4,
                'name' => 'Camiña',
                'order' => 0,
                'province_id' => 4,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 5,
                'name' => 'Colchane',
                'order' => 0,
                'province_id' => 4,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 6,
                'name' => 'Huara',
                'order' => 0,
                'province_id' => 4,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 7,
                'name' => 'Pica',
                'order' => 0,
                'province_id' => 4,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 8,
                'name' => 'Antofagasta',
                'order' => 0,
                'province_id' => 5,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 9,
                'name' => 'Mejillones',
                'order' => 0,
                'province_id' => 5,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 10,
                'name' => 'Sierra Gorda',
                'order' => 0,
                'province_id' => 5,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 11,
                'name' => 'Taltal',
                'order' => 0,
                'province_id' => 5,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 12,
                'name' => 'Calama',
                'order' => 0,
                'province_id' => 6,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 13,
                'name' => 'Ollagüe',
                'order' => 0,
                'province_id' => 6,
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 14,
                'name' => 'San Pedro de Atacama',
                'order' => 0,
                'province_id' => 6,
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 15,
                'name' => 'Tocopilla',
                'order' => 0,
                'province_id' => 7,
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 16,
                'name' => 'María Elena',
                'order' => 0,
                'province_id' => 7,
                'updated_at' => NULL,
            ),
            16 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 17,
                'name' => 'Copiapó',
                'order' => 0,
                'province_id' => 8,
                'updated_at' => NULL,
            ),
            17 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 18,
                'name' => 'Caldera',
                'order' => 0,
                'province_id' => 8,
                'updated_at' => NULL,
            ),
            18 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 19,
                'name' => 'Tierra Amarilla',
                'order' => 0,
                'province_id' => 8,
                'updated_at' => NULL,
            ),
            19 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 20,
                'name' => 'Chañaral',
                'order' => 0,
                'province_id' => 9,
                'updated_at' => NULL,
            ),
            20 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 21,
                'name' => 'Diego de Almagro',
                'order' => 0,
                'province_id' => 9,
                'updated_at' => NULL,
            ),
            21 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 22,
                'name' => 'Vallenar',
                'order' => 0,
                'province_id' => 10,
                'updated_at' => NULL,
            ),
            22 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 23,
                'name' => 'Alto del Carmen',
                'order' => 0,
                'province_id' => 10,
                'updated_at' => NULL,
            ),
            23 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 24,
                'name' => 'Freirina',
                'order' => 0,
                'province_id' => 10,
                'updated_at' => NULL,
            ),
            24 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 25,
                'name' => 'Huasco',
                'order' => 0,
                'province_id' => 10,
                'updated_at' => NULL,
            ),
            25 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 26,
                'name' => 'La Serena',
                'order' => 0,
                'province_id' => 11,
                'updated_at' => NULL,
            ),
            26 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 27,
                'name' => 'Coquimbo',
                'order' => 0,
                'province_id' => 11,
                'updated_at' => NULL,
            ),
            27 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 28,
                'name' => 'Andacollo',
                'order' => 0,
                'province_id' => 11,
                'updated_at' => NULL,
            ),
            28 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 29,
                'name' => 'La Higuera',
                'order' => 0,
                'province_id' => 11,
                'updated_at' => NULL,
            ),
            29 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 30,
                'name' => 'Paihuano',
                'order' => 0,
                'province_id' => 11,
                'updated_at' => NULL,
            ),
            30 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 31,
                'name' => 'Vicuña',
                'order' => 0,
                'province_id' => 11,
                'updated_at' => NULL,
            ),
            31 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 32,
                'name' => 'Illapel',
                'order' => 0,
                'province_id' => 12,
                'updated_at' => NULL,
            ),
            32 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 33,
                'name' => 'Canela',
                'order' => 0,
                'province_id' => 12,
                'updated_at' => NULL,
            ),
            33 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 34,
                'name' => 'Los Vilos',
                'order' => 0,
                'province_id' => 12,
                'updated_at' => NULL,
            ),
            34 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 35,
                'name' => 'Salamanca',
                'order' => 0,
                'province_id' => 12,
                'updated_at' => NULL,
            ),
            35 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 36,
                'name' => 'Ovalle',
                'order' => 0,
                'province_id' => 13,
                'updated_at' => NULL,
            ),
            36 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 37,
                'name' => 'Combarbalá',
                'order' => 0,
                'province_id' => 13,
                'updated_at' => NULL,
            ),
            37 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 38,
                'name' => 'Monte Patria',
                'order' => 0,
                'province_id' => 13,
                'updated_at' => NULL,
            ),
            38 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 39,
                'name' => 'Punitaqui',
                'order' => 0,
                'province_id' => 13,
                'updated_at' => NULL,
            ),
            39 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 40,
                'name' => 'Río Hurtado',
                'order' => 0,
                'province_id' => 13,
                'updated_at' => NULL,
            ),
            40 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 41,
                'name' => 'Valparaíso',
                'order' => 0,
                'province_id' => 14,
                'updated_at' => NULL,
            ),
            41 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 42,
                'name' => 'Casablanca',
                'order' => 0,
                'province_id' => 14,
                'updated_at' => NULL,
            ),
            42 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 43,
                'name' => 'Concón',
                'order' => 0,
                'province_id' => 14,
                'updated_at' => NULL,
            ),
            43 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 44,
                'name' => 'Juan Fernández',
                'order' => 0,
                'province_id' => 14,
                'updated_at' => NULL,
            ),
            44 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 45,
                'name' => 'Puchuncaví',
                'order' => 0,
                'province_id' => 14,
                'updated_at' => NULL,
            ),
            45 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 46,
                'name' => 'Quintero',
                'order' => 0,
                'province_id' => 14,
                'updated_at' => NULL,
            ),
            46 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 47,
                'name' => 'Viña del Mar',
                'order' => 0,
                'province_id' => 14,
                'updated_at' => NULL,
            ),
            47 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 48,
                'name' => 'Isla de Pascua',
                'order' => 0,
                'province_id' => 15,
                'updated_at' => NULL,
            ),
            48 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 49,
                'name' => 'Los Andes',
                'order' => 0,
                'province_id' => 16,
                'updated_at' => NULL,
            ),
            49 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 50,
                'name' => 'Calle Larga',
                'order' => 0,
                'province_id' => 16,
                'updated_at' => NULL,
            ),
            50 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 51,
                'name' => 'Rinconada',
                'order' => 0,
                'province_id' => 16,
                'updated_at' => NULL,
            ),
            51 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 52,
                'name' => 'San Esteban',
                'order' => 0,
                'province_id' => 16,
                'updated_at' => NULL,
            ),
            52 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 53,
                'name' => 'La Ligua',
                'order' => 0,
                'province_id' => 17,
                'updated_at' => NULL,
            ),
            53 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 54,
                'name' => 'Cabildo',
                'order' => 0,
                'province_id' => 17,
                'updated_at' => NULL,
            ),
            54 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 55,
                'name' => 'Papudo',
                'order' => 0,
                'province_id' => 17,
                'updated_at' => NULL,
            ),
            55 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 56,
                'name' => 'Petorca',
                'order' => 0,
                'province_id' => 17,
                'updated_at' => NULL,
            ),
            56 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 57,
                'name' => 'Zapallar',
                'order' => 0,
                'province_id' => 17,
                'updated_at' => NULL,
            ),
            57 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 58,
                'name' => 'Quillota',
                'order' => 0,
                'province_id' => 18,
                'updated_at' => NULL,
            ),
            58 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 59,
                'name' => 'La Calera',
                'order' => 0,
                'province_id' => 18,
                'updated_at' => NULL,
            ),
            59 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 60,
                'name' => 'Hijuelas',
                'order' => 0,
                'province_id' => 18,
                'updated_at' => NULL,
            ),
            60 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 61,
                'name' => 'La Cruz',
                'order' => 0,
                'province_id' => 18,
                'updated_at' => NULL,
            ),
            61 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 62,
                'name' => 'Nogales',
                'order' => 0,
                'province_id' => 18,
                'updated_at' => NULL,
            ),
            62 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 63,
                'name' => 'San Antonio',
                'order' => 0,
                'province_id' => 19,
                'updated_at' => NULL,
            ),
            63 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 64,
                'name' => 'Algarrobo',
                'order' => 0,
                'province_id' => 19,
                'updated_at' => NULL,
            ),
            64 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 65,
                'name' => 'Cartagena',
                'order' => 0,
                'province_id' => 19,
                'updated_at' => NULL,
            ),
            65 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 66,
                'name' => 'El Quisco',
                'order' => 0,
                'province_id' => 19,
                'updated_at' => NULL,
            ),
            66 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 67,
                'name' => 'El Tabo',
                'order' => 0,
                'province_id' => 19,
                'updated_at' => NULL,
            ),
            67 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 68,
                'name' => 'Santo Domingo',
                'order' => 0,
                'province_id' => 19,
                'updated_at' => NULL,
            ),
            68 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 69,
                'name' => 'San Felipe',
                'order' => 0,
                'province_id' => 20,
                'updated_at' => NULL,
            ),
            69 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 70,
                'name' => 'Catemu',
                'order' => 0,
                'province_id' => 20,
                'updated_at' => NULL,
            ),
            70 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 71,
                'name' => 'Llay Llay',
                'order' => 0,
                'province_id' => 20,
                'updated_at' => NULL,
            ),
            71 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 72,
                'name' => 'Panquehue',
                'order' => 0,
                'province_id' => 20,
                'updated_at' => NULL,
            ),
            72 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 73,
                'name' => 'Putaendo',
                'order' => 0,
                'province_id' => 20,
                'updated_at' => NULL,
            ),
            73 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 74,
                'name' => 'Santa María',
                'order' => 0,
                'province_id' => 20,
                'updated_at' => NULL,
            ),
            74 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 75,
                'name' => 'Quilpué',
                'order' => 0,
                'province_id' => 21,
                'updated_at' => NULL,
            ),
            75 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 76,
                'name' => 'Limache',
                'order' => 0,
                'province_id' => 21,
                'updated_at' => NULL,
            ),
            76 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 77,
                'name' => 'Olmué',
                'order' => 0,
                'province_id' => 21,
                'updated_at' => NULL,
            ),
            77 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 78,
                'name' => 'Villa Alemana',
                'order' => 0,
                'province_id' => 21,
                'updated_at' => NULL,
            ),
            78 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 79,
                'name' => 'Rancagua',
                'order' => 0,
                'province_id' => 22,
                'updated_at' => NULL,
            ),
            79 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 80,
                'name' => 'Codegua',
                'order' => 0,
                'province_id' => 22,
                'updated_at' => NULL,
            ),
            80 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 81,
                'name' => 'Coinco',
                'order' => 0,
                'province_id' => 22,
                'updated_at' => NULL,
            ),
            81 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 82,
                'name' => 'Coltauco',
                'order' => 0,
                'province_id' => 22,
                'updated_at' => NULL,
            ),
            82 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 83,
                'name' => 'Doñihue',
                'order' => 0,
                'province_id' => 22,
                'updated_at' => NULL,
            ),
            83 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 84,
                'name' => 'Graneros',
                'order' => 0,
                'province_id' => 22,
                'updated_at' => NULL,
            ),
            84 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 85,
                'name' => 'Las Cabras',
                'order' => 0,
                'province_id' => 22,
                'updated_at' => NULL,
            ),
            85 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 86,
                'name' => 'Machalí',
                'order' => 0,
                'province_id' => 22,
                'updated_at' => NULL,
            ),
            86 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 87,
                'name' => 'Malloa',
                'order' => 0,
                'province_id' => 22,
                'updated_at' => NULL,
            ),
            87 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 88,
                'name' => 'Mostazal',
                'order' => 0,
                'province_id' => 22,
                'updated_at' => NULL,
            ),
            88 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 89,
                'name' => 'Olivar',
                'order' => 0,
                'province_id' => 22,
                'updated_at' => NULL,
            ),
            89 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 90,
                'name' => 'Peumo',
                'order' => 0,
                'province_id' => 22,
                'updated_at' => NULL,
            ),
            90 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 91,
                'name' => 'Pichidegua',
                'order' => 0,
                'province_id' => 22,
                'updated_at' => NULL,
            ),
            91 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 92,
                'name' => 'Quinta de Tilcoco',
                'order' => 0,
                'province_id' => 22,
                'updated_at' => NULL,
            ),
            92 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 93,
                'name' => 'Rengo',
                'order' => 0,
                'province_id' => 22,
                'updated_at' => NULL,
            ),
            93 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 94,
                'name' => 'Requínoa',
                'order' => 0,
                'province_id' => 22,
                'updated_at' => NULL,
            ),
            94 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 95,
                'name' => 'San Vicente',
                'order' => 0,
                'province_id' => 22,
                'updated_at' => NULL,
            ),
            95 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 96,
                'name' => 'Pichilemu',
                'order' => 0,
                'province_id' => 23,
                'updated_at' => NULL,
            ),
            96 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 97,
                'name' => 'La Estrella',
                'order' => 0,
                'province_id' => 23,
                'updated_at' => NULL,
            ),
            97 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 98,
                'name' => 'Litueche',
                'order' => 0,
                'province_id' => 23,
                'updated_at' => NULL,
            ),
            98 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 99,
                'name' => 'Marchihue',
                'order' => 0,
                'province_id' => 23,
                'updated_at' => NULL,
            ),
            99 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 100,
                'name' => 'Navidad',
                'order' => 0,
                'province_id' => 23,
                'updated_at' => NULL,
            ),
            100 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 101,
                'name' => 'Paredones',
                'order' => 0,
                'province_id' => 23,
                'updated_at' => NULL,
            ),
            101 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 102,
                'name' => 'San Fernando',
                'order' => 0,
                'province_id' => 24,
                'updated_at' => NULL,
            ),
            102 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 103,
                'name' => 'Chépica',
                'order' => 0,
                'province_id' => 24,
                'updated_at' => NULL,
            ),
            103 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 104,
                'name' => 'Chimbarongo',
                'order' => 0,
                'province_id' => 24,
                'updated_at' => NULL,
            ),
            104 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 105,
                'name' => 'Lolol',
                'order' => 0,
                'province_id' => 24,
                'updated_at' => NULL,
            ),
            105 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 106,
                'name' => 'Nancagua',
                'order' => 0,
                'province_id' => 24,
                'updated_at' => NULL,
            ),
            106 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 107,
                'name' => 'Palmilla',
                'order' => 0,
                'province_id' => 24,
                'updated_at' => NULL,
            ),
            107 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 108,
                'name' => 'Peralillo',
                'order' => 0,
                'province_id' => 24,
                'updated_at' => NULL,
            ),
            108 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 109,
                'name' => 'Placilla',
                'order' => 0,
                'province_id' => 24,
                'updated_at' => NULL,
            ),
            109 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 110,
                'name' => 'Pumanque',
                'order' => 0,
                'province_id' => 24,
                'updated_at' => NULL,
            ),
            110 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 111,
                'name' => 'Santa Cruz',
                'order' => 0,
                'province_id' => 24,
                'updated_at' => NULL,
            ),
            111 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 112,
                'name' => 'Talca',
                'order' => 0,
                'province_id' => 25,
                'updated_at' => NULL,
            ),
            112 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 113,
                'name' => 'Constitución',
                'order' => 0,
                'province_id' => 25,
                'updated_at' => NULL,
            ),
            113 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 114,
                'name' => 'Curepto',
                'order' => 0,
                'province_id' => 25,
                'updated_at' => NULL,
            ),
            114 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 115,
                'name' => 'Empedrado',
                'order' => 0,
                'province_id' => 25,
                'updated_at' => NULL,
            ),
            115 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 116,
                'name' => 'Maule',
                'order' => 0,
                'province_id' => 25,
                'updated_at' => NULL,
            ),
            116 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 117,
                'name' => 'Pelarco',
                'order' => 0,
                'province_id' => 25,
                'updated_at' => NULL,
            ),
            117 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 118,
                'name' => 'Pencahue',
                'order' => 0,
                'province_id' => 25,
                'updated_at' => NULL,
            ),
            118 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 119,
                'name' => 'Río Claro',
                'order' => 0,
                'province_id' => 25,
                'updated_at' => NULL,
            ),
            119 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 120,
                'name' => 'San Clemente',
                'order' => 0,
                'province_id' => 25,
                'updated_at' => NULL,
            ),
            120 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 121,
                'name' => 'San Rafael',
                'order' => 0,
                'province_id' => 25,
                'updated_at' => NULL,
            ),
            121 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 122,
                'name' => 'Cauquenes',
                'order' => 0,
                'province_id' => 26,
                'updated_at' => NULL,
            ),
            122 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 123,
                'name' => 'Chanco',
                'order' => 0,
                'province_id' => 26,
                'updated_at' => NULL,
            ),
            123 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 124,
                'name' => 'Pelluhue',
                'order' => 0,
                'province_id' => 26,
                'updated_at' => NULL,
            ),
            124 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 125,
                'name' => 'Curicó',
                'order' => 0,
                'province_id' => 27,
                'updated_at' => NULL,
            ),
            125 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 126,
                'name' => 'Hualañé',
                'order' => 0,
                'province_id' => 27,
                'updated_at' => NULL,
            ),
            126 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 127,
                'name' => 'Licantén',
                'order' => 0,
                'province_id' => 27,
                'updated_at' => NULL,
            ),
            127 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 128,
                'name' => 'Molina',
                'order' => 0,
                'province_id' => 27,
                'updated_at' => NULL,
            ),
            128 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 129,
                'name' => 'Rauco',
                'order' => 0,
                'province_id' => 27,
                'updated_at' => NULL,
            ),
            129 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 130,
                'name' => 'Romeral',
                'order' => 0,
                'province_id' => 27,
                'updated_at' => NULL,
            ),
            130 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 131,
                'name' => 'Sagrada Familia',
                'order' => 0,
                'province_id' => 27,
                'updated_at' => NULL,
            ),
            131 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 132,
                'name' => 'Teno',
                'order' => 0,
                'province_id' => 27,
                'updated_at' => NULL,
            ),
            132 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 133,
                'name' => 'Vichuquén',
                'order' => 0,
                'province_id' => 27,
                'updated_at' => NULL,
            ),
            133 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 134,
                'name' => 'Linares',
                'order' => 0,
                'province_id' => 28,
                'updated_at' => NULL,
            ),
            134 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 135,
                'name' => 'Colbún',
                'order' => 0,
                'province_id' => 28,
                'updated_at' => NULL,
            ),
            135 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 136,
                'name' => 'Longaví',
                'order' => 0,
                'province_id' => 28,
                'updated_at' => NULL,
            ),
            136 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 137,
                'name' => 'Parral',
                'order' => 0,
                'province_id' => 28,
                'updated_at' => NULL,
            ),
            137 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 138,
                'name' => 'Retiro',
                'order' => 0,
                'province_id' => 28,
                'updated_at' => NULL,
            ),
            138 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 139,
                'name' => 'San Javier',
                'order' => 0,
                'province_id' => 28,
                'updated_at' => NULL,
            ),
            139 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 140,
                'name' => 'Villa Alegre',
                'order' => 0,
                'province_id' => 28,
                'updated_at' => NULL,
            ),
            140 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 141,
                'name' => 'Yerbas Buenas',
                'order' => 0,
                'province_id' => 28,
                'updated_at' => NULL,
            ),
            141 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 142,
                'name' => 'Concepción',
                'order' => 0,
                'province_id' => 29,
                'updated_at' => NULL,
            ),
            142 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 143,
                'name' => 'Coronel',
                'order' => 0,
                'province_id' => 29,
                'updated_at' => NULL,
            ),
            143 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 144,
                'name' => 'Chiguayante',
                'order' => 0,
                'province_id' => 29,
                'updated_at' => NULL,
            ),
            144 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 145,
                'name' => 'Florida',
                'order' => 0,
                'province_id' => 29,
                'updated_at' => NULL,
            ),
            145 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 146,
                'name' => 'Hualqui',
                'order' => 0,
                'province_id' => 29,
                'updated_at' => NULL,
            ),
            146 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 147,
                'name' => 'Lota',
                'order' => 0,
                'province_id' => 29,
                'updated_at' => NULL,
            ),
            147 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 148,
                'name' => 'Penco',
                'order' => 0,
                'province_id' => 29,
                'updated_at' => NULL,
            ),
            148 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 149,
                'name' => 'San Pedro de la Paz',
                'order' => 0,
                'province_id' => 29,
                'updated_at' => NULL,
            ),
            149 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 150,
                'name' => 'Santa Juana',
                'order' => 0,
                'province_id' => 29,
                'updated_at' => NULL,
            ),
            150 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 151,
                'name' => 'Talcahuano',
                'order' => 0,
                'province_id' => 29,
                'updated_at' => NULL,
            ),
            151 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 152,
                'name' => 'Tomé',
                'order' => 0,
                'province_id' => 29,
                'updated_at' => NULL,
            ),
            152 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 153,
                'name' => 'Hualpén',
                'order' => 0,
                'province_id' => 29,
                'updated_at' => NULL,
            ),
            153 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 154,
                'name' => 'Lebu',
                'order' => 0,
                'province_id' => 30,
                'updated_at' => NULL,
            ),
            154 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 155,
                'name' => 'Arauco',
                'order' => 0,
                'province_id' => 30,
                'updated_at' => NULL,
            ),
            155 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 156,
                'name' => 'Cañete',
                'order' => 0,
                'province_id' => 30,
                'updated_at' => NULL,
            ),
            156 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 157,
                'name' => 'Contulmo',
                'order' => 0,
                'province_id' => 30,
                'updated_at' => NULL,
            ),
            157 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 158,
                'name' => 'Curanilahue',
                'order' => 0,
                'province_id' => 30,
                'updated_at' => NULL,
            ),
            158 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 159,
                'name' => 'Los Álamos',
                'order' => 0,
                'province_id' => 30,
                'updated_at' => NULL,
            ),
            159 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 160,
                'name' => 'Tirúa',
                'order' => 0,
                'province_id' => 30,
                'updated_at' => NULL,
            ),
            160 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 161,
                'name' => 'Los Ángeles',
                'order' => 0,
                'province_id' => 31,
                'updated_at' => NULL,
            ),
            161 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 162,
                'name' => 'Antuco',
                'order' => 0,
                'province_id' => 31,
                'updated_at' => NULL,
            ),
            162 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 163,
                'name' => 'Cabrero',
                'order' => 0,
                'province_id' => 31,
                'updated_at' => NULL,
            ),
            163 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 164,
                'name' => 'Laja',
                'order' => 0,
                'province_id' => 31,
                'updated_at' => NULL,
            ),
            164 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 165,
                'name' => 'Mulchén',
                'order' => 0,
                'province_id' => 31,
                'updated_at' => NULL,
            ),
            165 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 166,
                'name' => 'Nacimiento',
                'order' => 0,
                'province_id' => 31,
                'updated_at' => NULL,
            ),
            166 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 167,
                'name' => 'Negrete',
                'order' => 0,
                'province_id' => 31,
                'updated_at' => NULL,
            ),
            167 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 168,
                'name' => 'Quilaco',
                'order' => 0,
                'province_id' => 31,
                'updated_at' => NULL,
            ),
            168 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 169,
                'name' => 'Quilleco',
                'order' => 0,
                'province_id' => 31,
                'updated_at' => NULL,
            ),
            169 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 170,
                'name' => 'San Rosendo',
                'order' => 0,
                'province_id' => 31,
                'updated_at' => NULL,
            ),
            170 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 171,
                'name' => 'Santa Bárbara',
                'order' => 0,
                'province_id' => 31,
                'updated_at' => NULL,
            ),
            171 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 172,
                'name' => 'Tucapel',
                'order' => 0,
                'province_id' => 31,
                'updated_at' => NULL,
            ),
            172 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 173,
                'name' => 'Yumbel',
                'order' => 0,
                'province_id' => 31,
                'updated_at' => NULL,
            ),
            173 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 174,
                'name' => 'Alto Biobío',
                'order' => 0,
                'province_id' => 31,
                'updated_at' => NULL,
            ),
            174 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 175,
                'name' => 'Chillán',
                'order' => 0,
                'province_id' => 32,
                'updated_at' => NULL,
            ),
            175 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 176,
                'name' => 'Bulnes',
                'order' => 0,
                'province_id' => 32,
                'updated_at' => NULL,
            ),
            176 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 177,
                'name' => 'Cobquecura',
                'order' => 0,
                'province_id' => 32,
                'updated_at' => NULL,
            ),
            177 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 178,
                'name' => 'Coelemu',
                'order' => 0,
                'province_id' => 32,
                'updated_at' => NULL,
            ),
            178 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 179,
                'name' => 'Coihueco',
                'order' => 0,
                'province_id' => 32,
                'updated_at' => NULL,
            ),
            179 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 180,
                'name' => 'Chillán Viejo',
                'order' => 0,
                'province_id' => 32,
                'updated_at' => NULL,
            ),
            180 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 181,
                'name' => 'El Carmen',
                'order' => 0,
                'province_id' => 32,
                'updated_at' => NULL,
            ),
            181 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 182,
                'name' => 'Ninhue',
                'order' => 0,
                'province_id' => 32,
                'updated_at' => NULL,
            ),
            182 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 183,
                'name' => 'Ñiquén',
                'order' => 0,
                'province_id' => 32,
                'updated_at' => NULL,
            ),
            183 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 184,
                'name' => 'Pemuco',
                'order' => 0,
                'province_id' => 32,
                'updated_at' => NULL,
            ),
            184 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 185,
                'name' => 'Pinto',
                'order' => 0,
                'province_id' => 32,
                'updated_at' => NULL,
            ),
            185 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 186,
                'name' => 'Portezuelo',
                'order' => 0,
                'province_id' => 32,
                'updated_at' => NULL,
            ),
            186 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 187,
                'name' => 'Quillón',
                'order' => 0,
                'province_id' => 32,
                'updated_at' => NULL,
            ),
            187 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 188,
                'name' => 'Quirihue',
                'order' => 0,
                'province_id' => 32,
                'updated_at' => NULL,
            ),
            188 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 189,
                'name' => 'Ránquil',
                'order' => 0,
                'province_id' => 32,
                'updated_at' => NULL,
            ),
            189 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 190,
                'name' => 'San Carlos',
                'order' => 0,
                'province_id' => 32,
                'updated_at' => NULL,
            ),
            190 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 191,
                'name' => 'San Fabián',
                'order' => 0,
                'province_id' => 32,
                'updated_at' => NULL,
            ),
            191 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 192,
                'name' => 'San Ignacio',
                'order' => 0,
                'province_id' => 32,
                'updated_at' => NULL,
            ),
            192 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 193,
                'name' => 'San Nicolás',
                'order' => 0,
                'province_id' => 32,
                'updated_at' => NULL,
            ),
            193 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 194,
                'name' => 'Treguaco',
                'order' => 0,
                'province_id' => 32,
                'updated_at' => NULL,
            ),
            194 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 195,
                'name' => 'Yungay',
                'order' => 0,
                'province_id' => 32,
                'updated_at' => NULL,
            ),
            195 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 196,
                'name' => 'Temuco',
                'order' => 0,
                'province_id' => 33,
                'updated_at' => NULL,
            ),
            196 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 197,
                'name' => 'Carahue',
                'order' => 0,
                'province_id' => 33,
                'updated_at' => NULL,
            ),
            197 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 198,
                'name' => 'Cunco',
                'order' => 0,
                'province_id' => 33,
                'updated_at' => NULL,
            ),
            198 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 199,
                'name' => 'Curarrehue',
                'order' => 0,
                'province_id' => 33,
                'updated_at' => NULL,
            ),
            199 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 200,
                'name' => 'Freire',
                'order' => 0,
                'province_id' => 33,
                'updated_at' => NULL,
            ),
            200 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 201,
                'name' => 'Galvarino',
                'order' => 0,
                'province_id' => 33,
                'updated_at' => NULL,
            ),
            201 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 202,
                'name' => 'Gorbea',
                'order' => 0,
                'province_id' => 33,
                'updated_at' => NULL,
            ),
            202 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 203,
                'name' => 'Lautaro',
                'order' => 0,
                'province_id' => 33,
                'updated_at' => NULL,
            ),
            203 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 204,
                'name' => 'Loncoche',
                'order' => 0,
                'province_id' => 33,
                'updated_at' => NULL,
            ),
            204 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 205,
                'name' => 'Melipeuco',
                'order' => 0,
                'province_id' => 33,
                'updated_at' => NULL,
            ),
            205 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 206,
                'name' => 'Nueva Imperial',
                'order' => 0,
                'province_id' => 33,
                'updated_at' => NULL,
            ),
            206 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 207,
                'name' => 'Padre las Casas',
                'order' => 0,
                'province_id' => 33,
                'updated_at' => NULL,
            ),
            207 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 208,
                'name' => 'Perquenco',
                'order' => 0,
                'province_id' => 33,
                'updated_at' => NULL,
            ),
            208 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 209,
                'name' => 'Pitrufquén',
                'order' => 0,
                'province_id' => 33,
                'updated_at' => NULL,
            ),
            209 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 210,
                'name' => 'Pucón',
                'order' => 0,
                'province_id' => 33,
                'updated_at' => NULL,
            ),
            210 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 211,
                'name' => 'Saavedra',
                'order' => 0,
                'province_id' => 33,
                'updated_at' => NULL,
            ),
            211 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 212,
                'name' => 'Teodoro Schmidt',
                'order' => 0,
                'province_id' => 33,
                'updated_at' => NULL,
            ),
            212 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 213,
                'name' => 'Toltén',
                'order' => 0,
                'province_id' => 33,
                'updated_at' => NULL,
            ),
            213 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 214,
                'name' => 'Vilcún',
                'order' => 0,
                'province_id' => 33,
                'updated_at' => NULL,
            ),
            214 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 215,
                'name' => 'Villarrica',
                'order' => 0,
                'province_id' => 33,
                'updated_at' => NULL,
            ),
            215 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 216,
                'name' => 'Cholchol',
                'order' => 0,
                'province_id' => 33,
                'updated_at' => NULL,
            ),
            216 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 217,
                'name' => 'Angol',
                'order' => 0,
                'province_id' => 34,
                'updated_at' => NULL,
            ),
            217 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 218,
                'name' => 'Collipulli',
                'order' => 0,
                'province_id' => 34,
                'updated_at' => NULL,
            ),
            218 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 219,
                'name' => 'Curacautín',
                'order' => 0,
                'province_id' => 34,
                'updated_at' => NULL,
            ),
            219 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 220,
                'name' => 'Ercilla',
                'order' => 0,
                'province_id' => 34,
                'updated_at' => NULL,
            ),
            220 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 221,
                'name' => 'Lonquimay',
                'order' => 0,
                'province_id' => 34,
                'updated_at' => NULL,
            ),
            221 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 222,
                'name' => 'Los Sauces',
                'order' => 0,
                'province_id' => 34,
                'updated_at' => NULL,
            ),
            222 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 223,
                'name' => 'Lumaco',
                'order' => 0,
                'province_id' => 34,
                'updated_at' => NULL,
            ),
            223 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 224,
                'name' => 'Purén',
                'order' => 0,
                'province_id' => 34,
                'updated_at' => NULL,
            ),
            224 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 225,
                'name' => 'Renaico',
                'order' => 0,
                'province_id' => 34,
                'updated_at' => NULL,
            ),
            225 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 226,
                'name' => 'Traiguén',
                'order' => 0,
                'province_id' => 34,
                'updated_at' => NULL,
            ),
            226 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 227,
                'name' => 'Victoria',
                'order' => 0,
                'province_id' => 34,
                'updated_at' => NULL,
            ),
            227 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 228,
                'name' => 'Puerto Montt',
                'order' => 0,
                'province_id' => 37,
                'updated_at' => NULL,
            ),
            228 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 229,
                'name' => 'Calbuco',
                'order' => 0,
                'province_id' => 37,
                'updated_at' => NULL,
            ),
            229 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 230,
                'name' => 'Cochamó',
                'order' => 0,
                'province_id' => 37,
                'updated_at' => NULL,
            ),
            230 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 231,
                'name' => 'Fresia',
                'order' => 0,
                'province_id' => 37,
                'updated_at' => NULL,
            ),
            231 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 232,
                'name' => 'Frutillar',
                'order' => 0,
                'province_id' => 37,
                'updated_at' => NULL,
            ),
            232 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 233,
                'name' => 'Los Muermos',
                'order' => 0,
                'province_id' => 37,
                'updated_at' => NULL,
            ),
            233 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 234,
                'name' => 'Llanquihue',
                'order' => 0,
                'province_id' => 37,
                'updated_at' => NULL,
            ),
            234 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 235,
                'name' => 'Maullín',
                'order' => 0,
                'province_id' => 37,
                'updated_at' => NULL,
            ),
            235 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 236,
                'name' => 'Puerto Varas',
                'order' => 0,
                'province_id' => 37,
                'updated_at' => NULL,
            ),
            236 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 237,
                'name' => 'Castro',
                'order' => 0,
                'province_id' => 38,
                'updated_at' => NULL,
            ),
            237 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 238,
                'name' => 'Ancud',
                'order' => 0,
                'province_id' => 38,
                'updated_at' => NULL,
            ),
            238 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 239,
                'name' => 'Chonchi',
                'order' => 0,
                'province_id' => 38,
                'updated_at' => NULL,
            ),
            239 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 240,
                'name' => 'Curaco de Vélez',
                'order' => 0,
                'province_id' => 38,
                'updated_at' => NULL,
            ),
            240 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 241,
                'name' => 'Dalcahue',
                'order' => 0,
                'province_id' => 38,
                'updated_at' => NULL,
            ),
            241 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 242,
                'name' => 'Puqueldón',
                'order' => 0,
                'province_id' => 38,
                'updated_at' => NULL,
            ),
            242 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 243,
                'name' => 'Queilén',
                'order' => 0,
                'province_id' => 38,
                'updated_at' => NULL,
            ),
            243 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 244,
                'name' => 'Quellón',
                'order' => 0,
                'province_id' => 38,
                'updated_at' => NULL,
            ),
            244 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 245,
                'name' => 'Quemchi',
                'order' => 0,
                'province_id' => 38,
                'updated_at' => NULL,
            ),
            245 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 246,
                'name' => 'Quinchao',
                'order' => 0,
                'province_id' => 38,
                'updated_at' => NULL,
            ),
            246 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 247,
                'name' => 'Osorno',
                'order' => 0,
                'province_id' => 39,
                'updated_at' => NULL,
            ),
            247 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 248,
                'name' => 'Puerto Octay',
                'order' => 0,
                'province_id' => 39,
                'updated_at' => NULL,
            ),
            248 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 249,
                'name' => 'Purranque',
                'order' => 0,
                'province_id' => 39,
                'updated_at' => NULL,
            ),
            249 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 250,
                'name' => 'Puyehue',
                'order' => 0,
                'province_id' => 39,
                'updated_at' => NULL,
            ),
            250 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 251,
                'name' => 'Río Negro',
                'order' => 0,
                'province_id' => 39,
                'updated_at' => NULL,
            ),
            251 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 252,
                'name' => 'San Juan de la Costa',
                'order' => 0,
                'province_id' => 39,
                'updated_at' => NULL,
            ),
            252 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 253,
                'name' => 'San Pablo',
                'order' => 0,
                'province_id' => 39,
                'updated_at' => NULL,
            ),
            253 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 254,
                'name' => 'Chaitén',
                'order' => 0,
                'province_id' => 40,
                'updated_at' => NULL,
            ),
            254 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 255,
                'name' => 'Futaleufú',
                'order' => 0,
                'province_id' => 40,
                'updated_at' => NULL,
            ),
            255 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 256,
                'name' => 'Hualaihué',
                'order' => 0,
                'province_id' => 40,
                'updated_at' => NULL,
            ),
            256 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 257,
                'name' => 'Palena',
                'order' => 0,
                'province_id' => 40,
                'updated_at' => NULL,
            ),
            257 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 258,
                'name' => 'Coyhaique',
                'order' => 0,
                'province_id' => 41,
                'updated_at' => NULL,
            ),
            258 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 259,
                'name' => 'Lago Verde',
                'order' => 0,
                'province_id' => 41,
                'updated_at' => NULL,
            ),
            259 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 260,
                'name' => 'Aysén',
                'order' => 0,
                'province_id' => 42,
                'updated_at' => NULL,
            ),
            260 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 261,
                'name' => 'Cisnes',
                'order' => 0,
                'province_id' => 42,
                'updated_at' => NULL,
            ),
            261 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 262,
                'name' => 'Guaitecas',
                'order' => 0,
                'province_id' => 42,
                'updated_at' => NULL,
            ),
            262 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 263,
                'name' => 'Cochrane',
                'order' => 0,
                'province_id' => 43,
                'updated_at' => NULL,
            ),
            263 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 264,
                'name' => 'O\'Higgins',
                'order' => 0,
                'province_id' => 43,
                'updated_at' => NULL,
            ),
            264 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 265,
                'name' => 'Tortel',
                'order' => 0,
                'province_id' => 43,
                'updated_at' => NULL,
            ),
            265 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 266,
                'name' => 'Chile Chico',
                'order' => 0,
                'province_id' => 44,
                'updated_at' => NULL,
            ),
            266 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 267,
                'name' => 'Río Ibáñez',
                'order' => 0,
                'province_id' => 44,
                'updated_at' => NULL,
            ),
            267 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 268,
                'name' => 'Punta Arenas',
                'order' => 0,
                'province_id' => 45,
                'updated_at' => NULL,
            ),
            268 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 269,
                'name' => 'Laguna Blanca',
                'order' => 0,
                'province_id' => 45,
                'updated_at' => NULL,
            ),
            269 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 270,
                'name' => 'Río Verde',
                'order' => 0,
                'province_id' => 45,
                'updated_at' => NULL,
            ),
            270 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 271,
                'name' => 'San Gregorio',
                'order' => 0,
                'province_id' => 45,
                'updated_at' => NULL,
            ),
            271 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 272,
                'name' => 'Cabo de Hornos',
                'order' => 0,
                'province_id' => 46,
                'updated_at' => NULL,
            ),
            272 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 273,
                'name' => 'Antártica',
                'order' => 0,
                'province_id' => 46,
                'updated_at' => NULL,
            ),
            273 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 274,
                'name' => 'Porvenir',
                'order' => 0,
                'province_id' => 47,
                'updated_at' => NULL,
            ),
            274 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 275,
                'name' => 'Primavera',
                'order' => 0,
                'province_id' => 47,
                'updated_at' => NULL,
            ),
            275 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 276,
                'name' => 'Timaukel',
                'order' => 0,
                'province_id' => 47,
                'updated_at' => NULL,
            ),
            276 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 277,
                'name' => 'Natales',
                'order' => 0,
                'province_id' => 48,
                'updated_at' => NULL,
            ),
            277 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 278,
                'name' => 'Torres del Paine',
                'order' => 0,
                'province_id' => 48,
                'updated_at' => NULL,
            ),
            278 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 279,
                'name' => 'Santiago',
                'order' => 0,
                'province_id' => 49,
                'updated_at' => NULL,
            ),
            279 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 280,
                'name' => 'Cerrillos',
                'order' => 0,
                'province_id' => 49,
                'updated_at' => NULL,
            ),
            280 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 281,
                'name' => 'Cerro Navia',
                'order' => 0,
                'province_id' => 49,
                'updated_at' => NULL,
            ),
            281 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 282,
                'name' => 'Conchalí',
                'order' => 0,
                'province_id' => 49,
                'updated_at' => NULL,
            ),
            282 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 283,
                'name' => 'El Bosque',
                'order' => 0,
                'province_id' => 49,
                'updated_at' => NULL,
            ),
            283 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 284,
                'name' => 'Estación Central',
                'order' => 0,
                'province_id' => 49,
                'updated_at' => NULL,
            ),
            284 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 285,
                'name' => 'Huechuraba',
                'order' => 0,
                'province_id' => 49,
                'updated_at' => NULL,
            ),
            285 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 286,
                'name' => 'Independencia',
                'order' => 0,
                'province_id' => 49,
                'updated_at' => NULL,
            ),
            286 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 287,
                'name' => 'La Cisterna',
                'order' => 0,
                'province_id' => 49,
                'updated_at' => NULL,
            ),
            287 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 288,
                'name' => 'La Florida',
                'order' => 0,
                'province_id' => 49,
                'updated_at' => NULL,
            ),
            288 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 289,
                'name' => 'La Granja',
                'order' => 0,
                'province_id' => 49,
                'updated_at' => NULL,
            ),
            289 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 290,
                'name' => 'La Pintana',
                'order' => 0,
                'province_id' => 49,
                'updated_at' => NULL,
            ),
            290 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 291,
                'name' => 'La Reina',
                'order' => 0,
                'province_id' => 49,
                'updated_at' => NULL,
            ),
            291 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 292,
                'name' => 'Las Condes',
                'order' => 0,
                'province_id' => 49,
                'updated_at' => NULL,
            ),
            292 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 293,
                'name' => 'Lo Barnechea',
                'order' => 0,
                'province_id' => 49,
                'updated_at' => NULL,
            ),
            293 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 294,
                'name' => 'Lo Espejo',
                'order' => 0,
                'province_id' => 49,
                'updated_at' => NULL,
            ),
            294 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 295,
                'name' => 'Lo Prado',
                'order' => 0,
                'province_id' => 49,
                'updated_at' => NULL,
            ),
            295 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 296,
                'name' => 'Macul',
                'order' => 0,
                'province_id' => 49,
                'updated_at' => NULL,
            ),
            296 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 297,
                'name' => 'Maipú',
                'order' => 0,
                'province_id' => 49,
                'updated_at' => NULL,
            ),
            297 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 298,
                'name' => 'Ñuñoa',
                'order' => 0,
                'province_id' => 49,
                'updated_at' => NULL,
            ),
            298 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 299,
                'name' => 'Pedro Aguirre Cerda',
                'order' => 0,
                'province_id' => 49,
                'updated_at' => NULL,
            ),
            299 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 300,
                'name' => 'Peñalolén',
                'order' => 0,
                'province_id' => 49,
                'updated_at' => NULL,
            ),
            300 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 301,
                'name' => 'Providencia',
                'order' => 0,
                'province_id' => 49,
                'updated_at' => NULL,
            ),
            301 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 302,
                'name' => 'Pudahuel',
                'order' => 0,
                'province_id' => 49,
                'updated_at' => NULL,
            ),
            302 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 303,
                'name' => 'Quilicura',
                'order' => 0,
                'province_id' => 49,
                'updated_at' => NULL,
            ),
            303 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 304,
                'name' => 'Quinta Normal',
                'order' => 0,
                'province_id' => 49,
                'updated_at' => NULL,
            ),
            304 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 305,
                'name' => 'Recoleta',
                'order' => 0,
                'province_id' => 49,
                'updated_at' => NULL,
            ),
            305 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 306,
                'name' => 'Renca',
                'order' => 0,
                'province_id' => 49,
                'updated_at' => NULL,
            ),
            306 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 307,
                'name' => 'San Joaquín',
                'order' => 0,
                'province_id' => 49,
                'updated_at' => NULL,
            ),
            307 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 308,
                'name' => 'San Miguel',
                'order' => 0,
                'province_id' => 49,
                'updated_at' => NULL,
            ),
            308 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 309,
                'name' => 'San Ramón',
                'order' => 0,
                'province_id' => 49,
                'updated_at' => NULL,
            ),
            309 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 310,
                'name' => 'Vitacura',
                'order' => 0,
                'province_id' => 49,
                'updated_at' => NULL,
            ),
            310 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 311,
                'name' => 'Puente Alto',
                'order' => 0,
                'province_id' => 50,
                'updated_at' => NULL,
            ),
            311 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 312,
                'name' => 'Pirque',
                'order' => 0,
                'province_id' => 50,
                'updated_at' => NULL,
            ),
            312 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 313,
                'name' => 'San José de Maipo',
                'order' => 0,
                'province_id' => 50,
                'updated_at' => NULL,
            ),
            313 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 314,
                'name' => 'Colina',
                'order' => 0,
                'province_id' => 51,
                'updated_at' => NULL,
            ),
            314 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 315,
                'name' => 'Lampa',
                'order' => 0,
                'province_id' => 51,
                'updated_at' => NULL,
            ),
            315 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 316,
                'name' => 'Tiltil',
                'order' => 0,
                'province_id' => 51,
                'updated_at' => NULL,
            ),
            316 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 317,
                'name' => 'San Bernardo',
                'order' => 0,
                'province_id' => 52,
                'updated_at' => NULL,
            ),
            317 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 318,
                'name' => 'Buin',
                'order' => 0,
                'province_id' => 52,
                'updated_at' => NULL,
            ),
            318 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 319,
                'name' => 'Calera de Tango',
                'order' => 0,
                'province_id' => 52,
                'updated_at' => NULL,
            ),
            319 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 320,
                'name' => 'Paine',
                'order' => 0,
                'province_id' => 52,
                'updated_at' => NULL,
            ),
            320 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 321,
                'name' => 'Melipilla',
                'order' => 0,
                'province_id' => 53,
                'updated_at' => NULL,
            ),
            321 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 322,
                'name' => 'Alhué',
                'order' => 0,
                'province_id' => 53,
                'updated_at' => NULL,
            ),
            322 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 323,
                'name' => 'Curacaví',
                'order' => 0,
                'province_id' => 53,
                'updated_at' => NULL,
            ),
            323 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 324,
                'name' => 'María Pinto',
                'order' => 0,
                'province_id' => 53,
                'updated_at' => NULL,
            ),
            324 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 325,
                'name' => 'San Pedro',
                'order' => 0,
                'province_id' => 53,
                'updated_at' => NULL,
            ),
            325 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 326,
                'name' => 'Talagante',
                'order' => 0,
                'province_id' => 54,
                'updated_at' => NULL,
            ),
            326 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 327,
                'name' => 'El Monte',
                'order' => 0,
                'province_id' => 54,
                'updated_at' => NULL,
            ),
            327 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 328,
                'name' => 'Isla de Maipo',
                'order' => 0,
                'province_id' => 54,
                'updated_at' => NULL,
            ),
            328 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 329,
                'name' => 'Padre Hurtado',
                'order' => 0,
                'province_id' => 54,
                'updated_at' => NULL,
            ),
            329 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 330,
                'name' => 'Peñaflor',
                'order' => 0,
                'province_id' => 54,
                'updated_at' => NULL,
            ),
            330 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 331,
                'name' => 'Valdivia',
                'order' => 0,
                'province_id' => 35,
                'updated_at' => NULL,
            ),
            331 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 332,
                'name' => 'Corral',
                'order' => 0,
                'province_id' => 35,
                'updated_at' => NULL,
            ),
            332 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 333,
                'name' => 'Lanco',
                'order' => 0,
                'province_id' => 35,
                'updated_at' => NULL,
            ),
            333 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 334,
                'name' => 'Los Lagos',
                'order' => 0,
                'province_id' => 35,
                'updated_at' => NULL,
            ),
            334 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 335,
                'name' => 'Máfil',
                'order' => 0,
                'province_id' => 35,
                'updated_at' => NULL,
            ),
            335 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 336,
                'name' => 'Mariquina',
                'order' => 0,
                'province_id' => 35,
                'updated_at' => NULL,
            ),
            336 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 337,
                'name' => 'Paillaco',
                'order' => 0,
                'province_id' => 35,
                'updated_at' => NULL,
            ),
            337 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 338,
                'name' => 'Panguipulli',
                'order' => 0,
                'province_id' => 35,
                'updated_at' => NULL,
            ),
            338 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 339,
                'name' => 'La Unión',
                'order' => 0,
                'province_id' => 36,
                'updated_at' => NULL,
            ),
            339 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 340,
                'name' => 'Futrono',
                'order' => 0,
                'province_id' => 36,
                'updated_at' => NULL,
            ),
            340 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 341,
                'name' => 'Lago Ranco',
                'order' => 0,
                'province_id' => 36,
                'updated_at' => NULL,
            ),
            341 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 342,
                'name' => 'Río Bueno',
                'order' => 0,
                'province_id' => 36,
                'updated_at' => NULL,
            ),
            342 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 343,
                'name' => 'Arica',
                'order' => 0,
                'province_id' => 1,
                'updated_at' => NULL,
            ),
            343 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 344,
                'name' => 'Camarones',
                'order' => 0,
                'province_id' => 1,
                'updated_at' => NULL,
            ),
            344 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 345,
                'name' => 'Putre',
                'order' => 0,
                'province_id' => 2,
                'updated_at' => NULL,
            ),
            345 => 
            array (
                'created_at' => NULL,
                'deleted_at' => NULL,
                'id' => 346,
                'name' => 'General Lagos',
                'order' => 0,
                'province_id' => 2,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}