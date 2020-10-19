<?php

use Illuminate\Database\Seeder;

class BanksTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('banks')->delete();
        
        \DB::table('banks')->insert(array (
            0 => 
            array (
                'code' => '01',
                'created_at' => '2020-10-18 20:24:06',
                'id' => 1,
                'name' => 'Banco de Chile',
                'updated_at' => '2020-10-18 20:24:06',
            ),
            1 => 
            array (
                'code' => '02',
                'created_at' => '2020-10-18 20:24:16',
                'id' => 2,
                'name' => 'Banco Internacional',
                'updated_at' => '2020-10-18 20:24:16',
            ),
            2 => 
            array (
                'code' => '03',
                'created_at' => '2020-10-18 20:24:26',
                'id' => 3,
                'name' => 'Scotiabank Chile',
                'updated_at' => '2020-10-18 20:24:26',
            ),
            3 => 
            array (
                'code' => '04',
                'created_at' => '2020-10-18 20:24:38',
                'id' => 4,
                'name' => 'Banco de Crédito e Inversiones',
                'updated_at' => '2020-10-18 20:24:38',
            ),
            4 => 
            array (
                'code' => '05',
                'created_at' => '2020-10-18 20:24:46',
                'id' => 5,
                'name' => 'Corpbanca',
                'updated_at' => '2020-10-18 20:24:46',
            ),
            5 => 
            array (
                'code' => '06',
                'created_at' => '2020-10-18 20:24:58',
                'id' => 6,
                'name' => 'Banco Bice',
                'updated_at' => '2020-10-18 20:24:58',
            ),
            6 => 
            array (
                'code' => '07',
                'created_at' => '2020-10-18 20:25:08',
                'id' => 7,
            'name' => 'HSBC Bank (Chile)',
                'updated_at' => '2020-10-18 20:25:08',
            ),
            7 => 
            array (
                'code' => '08',
                'created_at' => '2020-10-18 20:25:19',
                'id' => 8,
                'name' => 'Banco Santander',
                'updated_at' => '2020-10-18 20:25:19',
            ),
            8 => 
            array (
                'code' => '09',
                'created_at' => '2020-10-18 20:25:28',
                'id' => 9,
                'name' => 'Banco Itaú Chile',
                'updated_at' => '2020-10-18 20:25:28',
            ),
            9 => 
            array (
                'code' => '10',
                'created_at' => '2020-10-18 20:25:37',
                'id' => 10,
                'name' => 'Banco Security',
                'updated_at' => '2020-10-18 20:25:37',
            ),
            10 => 
            array (
                'code' => '11',
                'created_at' => '2020-10-18 20:25:46',
                'id' => 11,
                'name' => 'Banco Falabella',
                'updated_at' => '2020-10-18 20:25:46',
            ),
            11 => 
            array (
                'code' => '12',
                'created_at' => '2020-10-18 20:25:54',
                'id' => 12,
                'name' => 'Deutsche Bank',
                'updated_at' => '2020-10-18 20:25:54',
            ),
            12 => 
            array (
                'code' => '13',
                'created_at' => '2020-10-18 20:26:02',
                'id' => 13,
                'name' => 'Banco Ripley',
                'updated_at' => '2020-10-18 20:28:13',
            ),
            13 => 
            array (
                'code' => '14',
                'created_at' => '2020-10-18 20:26:21',
                'id' => 14,
                'name' => 'Rabobank Chile',
                'updated_at' => '2020-10-18 20:26:21',
            ),
            14 => 
            array (
                'code' => '15',
                'created_at' => '2020-10-18 20:26:33',
                'id' => 15,
                'name' => 'Banco Consorcio',
                'updated_at' => '2020-10-18 20:26:33',
            ),
            15 => 
            array (
                'code' => '16',
                'created_at' => '2020-10-18 20:26:42',
                'id' => 16,
                'name' => 'Banco Penta',
                'updated_at' => '2020-10-18 20:26:42',
            ),
            16 => 
            array (
                'code' => '17',
                'created_at' => '2020-10-18 20:26:52',
                'id' => 17,
                'name' => 'Banco Paris',
                'updated_at' => '2020-10-18 20:26:52',
            ),
            17 => 
            array (
                'code' => '18',
                'created_at' => '2020-10-18 20:27:02',
                'id' => 18,
            'name' => 'Banco Bilbao Vizcaya Argentaria (BBVA)',
                'updated_at' => '2020-10-18 20:27:02',
            ),
            18 => 
            array (
                'code' => '19',
                'created_at' => '2020-10-18 20:27:12',
                'id' => 19,
                'name' => 'Banco BTG Pactual Chile',
                'updated_at' => '2020-10-18 20:27:12',
            ),
            19 => 
            array (
                'code' => '20',
                'created_at' => '2020-10-18 20:28:28',
                'id' => 20,
                'name' => 'Banco Estado',
                'updated_at' => '2020-10-18 20:28:28',
            ),
        ));
        
        
    }
}