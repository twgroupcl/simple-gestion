<?php

use Illuminate\Database\Seeder;

class SellerCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('seller_categories')->delete();
        
        \DB::table('seller_categories')->insert(array (
            0 => 
            array (
                'code' => '01',
                'company_id' => 1,
                'created_at' => '2020-10-19 17:11:43',
                'deleted_at' => NULL,
                'id' => 1,
                'name' => 'Accesorios de Moda',
                'slug' => 'accesorios-de-moda',
                'status' => 1,
                'updated_at' => '2020-10-19 17:11:43',
            ),
            1 => 
            array (
                'code' => '02',
                'company_id' => 1,
                'created_at' => '2020-10-19 17:11:51',
                'deleted_at' => NULL,
                'id' => 2,
                'name' => 'Accesorios para Vehículos',
                'slug' => 'accesorios-para-vehculos',
                'status' => 1,
                'updated_at' => '2020-10-19 17:11:51',
            ),
            2 => 
            array (
                'code' => '03',
                'company_id' => 1,
                'created_at' => '2020-10-19 17:12:00',
                'deleted_at' => NULL,
                'id' => 3,
                'name' => 'Alimentos y Bebidas',
                'slug' => 'alimentos-y-bebidas',
                'status' => 1,
                'updated_at' => '2020-10-19 17:12:00',
            ),
            3 => 
            array (
                'code' => '04',
                'company_id' => 1,
                'created_at' => '2020-10-19 17:12:09',
                'deleted_at' => NULL,
                'id' => 4,
                'name' => 'Autos, Motos y Otros',
                'slug' => 'autos-motos-y-otros',
                'status' => 1,
                'updated_at' => '2020-10-19 17:12:09',
            ),
            4 => 
            array (
                'code' => '05',
                'company_id' => 1,
                'created_at' => '2020-10-19 17:12:20',
                'deleted_at' => NULL,
                'id' => 5,
                'name' => 'Bebés',
                'slug' => 'bebs',
                'status' => 1,
                'updated_at' => '2020-10-19 17:12:20',
            ),
            5 => 
            array (
                'code' => '06',
                'company_id' => 1,
                'created_at' => '2020-10-19 17:12:37',
                'deleted_at' => NULL,
                'id' => 6,
                'name' => 'Belleza, Salud y Cuidado Personal',
                'slug' => 'belleza-salud-y-cuidado-personal',
                'status' => 1,
                'updated_at' => '2020-10-19 17:12:37',
            ),
            6 => 
            array (
                'code' => '07',
                'company_id' => 1,
                'created_at' => '2020-10-19 17:12:47',
                'deleted_at' => NULL,
                'id' => 7,
                'name' => 'Cámaras y Accesorios',
                'slug' => 'cmaras-y-accesorios',
                'status' => 1,
                'updated_at' => '2020-10-19 17:12:47',
            ),
            7 => 
            array (
                'code' => '08',
                'company_id' => 1,
                'created_at' => '2020-10-19 17:12:55',
                'deleted_at' => NULL,
                'id' => 8,
                'name' => 'Celulares y Telefonía',
                'slug' => 'celulares-y-telefona',
                'status' => 1,
                'updated_at' => '2020-10-19 17:12:55',
            ),
            8 => 
            array (
                'code' => '09',
                'company_id' => 1,
                'created_at' => '2020-10-19 17:13:02',
                'deleted_at' => NULL,
                'id' => 9,
                'name' => 'Computación',
                'slug' => 'computacin',
                'status' => 1,
                'updated_at' => '2020-10-19 17:13:02',
            ),
            9 => 
            array (
                'code' => '10',
                'company_id' => 1,
                'created_at' => '2020-10-19 17:13:12',
                'deleted_at' => NULL,
                'id' => 10,
                'name' => 'Consolas y Videojuegos',
                'slug' => 'consolas-y-videojuegos',
                'status' => 1,
                'updated_at' => '2020-10-19 17:13:12',
            ),
            10 => 
            array (
                'code' => '11',
                'company_id' => 1,
                'created_at' => '2020-10-19 17:13:20',
                'deleted_at' => NULL,
                'id' => 11,
                'name' => 'Deportes y Fitness',
                'slug' => 'deportes-y-fitness',
                'status' => 1,
                'updated_at' => '2020-10-19 17:13:20',
            ),
            11 => 
            array (
                'code' => '12',
                'company_id' => 1,
                'created_at' => '2020-10-19 17:13:30',
                'deleted_at' => NULL,
                'id' => 12,
                'name' => 'Electrodomésticos',
                'slug' => 'electrodomsticos',
                'status' => 1,
                'updated_at' => '2020-10-19 17:13:30',
            ),
            12 => 
            array (
                'code' => '13',
                'company_id' => 1,
                'created_at' => '2020-10-19 17:13:46',
                'deleted_at' => NULL,
                'id' => 13,
                'name' => 'Electrónica, Audio y Video',
                'slug' => 'electrnica-audio-y-video',
                'status' => 1,
                'updated_at' => '2020-10-19 17:13:46',
            ),
            13 => 
            array (
                'code' => '14',
                'company_id' => 1,
                'created_at' => '2020-10-19 17:13:54',
                'deleted_at' => NULL,
                'id' => 14,
                'name' => 'Hogar y Muebles',
                'slug' => 'hogar-y-muebles',
                'status' => 1,
                'updated_at' => '2020-10-19 17:13:54',
            ),
            14 => 
            array (
                'code' => '15',
                'company_id' => 1,
                'created_at' => '2020-10-19 17:14:04',
                'deleted_at' => NULL,
                'id' => 15,
                'name' => 'Instituciones Benéficas',
                'slug' => 'instituciones-benficas',
                'status' => 1,
                'updated_at' => '2020-10-19 17:14:04',
            ),
            15 => 
            array (
                'code' => '16',
                'company_id' => 1,
                'created_at' => '2020-10-19 17:14:12',
                'deleted_at' => NULL,
                'id' => 16,
                'name' => 'Juegos y Juguetes',
                'slug' => 'juegos-y-juguetes',
                'status' => 1,
                'updated_at' => '2020-10-19 17:14:12',
            ),
            16 => 
            array (
                'code' => '17',
                'company_id' => 1,
                'created_at' => '2020-10-19 17:14:18',
                'deleted_at' => NULL,
                'id' => 17,
                'name' => 'Mascotas',
                'slug' => 'mascotas',
                'status' => 1,
                'updated_at' => '2020-10-19 17:14:18',
            ),
            17 => 
            array (
                'code' => '18',
                'company_id' => 1,
                'created_at' => '2020-10-19 17:14:28',
                'deleted_at' => NULL,
                'id' => 18,
                'name' => 'Robótica y Tecnología',
                'slug' => 'robtica-y-tecnologa',
                'status' => 1,
                'updated_at' => '2020-10-19 17:14:28',
            ),
            18 => 
            array (
                'code' => '19',
                'company_id' => 1,
                'created_at' => '2020-10-19 17:14:34',
                'deleted_at' => NULL,
                'id' => 19,
                'name' => 'Servicios',
                'slug' => 'servicios',
                'status' => 1,
                'updated_at' => '2020-10-19 17:14:34',
            ),
            19 => 
            array (
                'code' => '20',
                'company_id' => 1,
                'created_at' => '2020-10-19 17:14:42',
                'deleted_at' => NULL,
                'id' => 20,
                'name' => 'Vestuario y Calzado',
                'slug' => 'vestuario-y-calzado',
                'status' => 1,
                'updated_at' => '2020-10-19 17:14:42',
            ),
            20 => 
            array (
                'code' => '21',
                'company_id' => 1,
                'created_at' => '2020-10-19 17:14:50',
                'deleted_at' => NULL,
                'id' => 21,
                'name' => 'Viajes y Turismo',
                'slug' => 'viajes-y-turismo',
                'status' => 1,
                'updated_at' => '2020-10-19 17:14:50',
            ),
        ));
        
        
    }
}