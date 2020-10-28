<?php

use Illuminate\Database\Seeder;

class FaqTopicTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('faq_topic')->delete();
        
        \DB::table('faq_topic')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'Titulo 1',
                'description' => 'Descripcion 1',
                'icon' => '<i class="czi-user-circle h2 mt-2 mb-4 text-primary"></i>',
                'slug' => 'faq-topic-1',
                'created_at' => '2020-10-09 18:57:20',
                'deleted_at' => NULL,
                'updated_at' => '2020-10-16 10:18:13',
                'status' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'Titulo 2',
                'description' => 'Descripcion Faq 2',
                'icon' => '<i class="czi-laptop h2 mt-2 mb-4 text-primary"></i>',
                'slug' => 'faq-topic-2',
                'created_at' => '2020-10-09 18:57:20',
                'deleted_at' => NULL,
                'updated_at' => '2020-10-16 10:18:13',
                'status' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'title' => 'Titulo de Faq 3',
                'description' => 'Descripcion Faq 3',
                'icon' => '<i class="czi-card h2 mt-2 mb-4 text-primary"></i>',
                'slug' => 'faq-topic-3',
                'created_at' => '2020-10-09 18:57:20',
                'deleted_at' => NULL,
                'updated_at' => '2020-10-16 10:18:13',
                'status' => 1,
            ),
            3 => 
            array (
                'id' => 3,
                'title' => 'Titulo de Faq 4',
                'description' => 'Descripcion 4',
                'icon' => '<i class="czi-delivery h2 mt-2 mb-4 text-primary"></i>',
                'slug' => 'faq-topic-4',
                'created_at' => '2020-10-09 18:57:20',
                'deleted_at' => NULL,
                'updated_at' => '2020-10-16 10:18:13',
                'status' => 2,
            ),
            4 => 
            array (
                'id' => 4,
                'title' => 'Titulo de Faq 5',
                'description' => 'Descripcion de faq 5',
                'icon' => '<i class="czi-currency-exchange h2 mt-2 mb-4 text-primary"></i>',
                'slug' => 'faq-topic-5',
                'created_at' => '2020-10-09 18:57:20',
                'deleted_at' => NULL,
                'updated_at' => '2020-10-16 10:18:13',
                'status' => 1,
            ),
        ));
    }
}
