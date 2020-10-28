<?php

use Illuminate\Database\Seeder;

class FaqAnswerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('faq_answer')->delete();
        
        \DB::table('faq_answer')->insert(array (
            0 => 
            array (
                'id' => 1,
                'question' => 'Pregunta 1',
                'answer' => 'Respuesta 1',
                'id_topic' => '1',
                'slug' => 'faq-1',
                'status' => 1,
                'created_at' => '2020-10-09 18:57:20',
                'updated_at' => '2020-10-16 10:18:13',
            ),
            1 => 
            array (
                'id' => 2,
                'question' => 'Pregunta 2',
                'answer' => 'Respuesta 2',
                'id_topic' => '2',
                'slug' => 'faq-2',
                'status' => 1,
                'created_at' => '2020-10-09 18:57:20',
                'updated_at' => '2020-10-16 10:18:13',
            ),
            2 => 
            array (
                'id' => 3,
                'question' => 'Pregunta 3',
                'answer' => 'Respuesta 3',
                'id_topic' => '3',
                'slug' => 'faq-3',
                'status' => 1,
                'created_at' => '2020-10-09 18:57:20',
                'updated_at' => '2020-10-16 10:18:13',
            ),
            3 => 
            array (
                'id' => 4,
                'question' => 'Pregunta 4',
                'answer' => 'Respuesta 4',
                'id_topic' => '4',
                'slug' => 'faq-4',
                'status' => 2,
                'created_at' => '2020-10-09 18:57:20',
                'updated_at' => '2020-10-16 10:18:13',
            ),
            4 => 
            array (
                'id' => 5,
                'question' => 'Pregunta 5',
                'answer' => 'Respuesta 5',
                'id_topic' => '5',
                'slug' => 'faq-5',
                'status' => 1,
                'created_at' => '2020-10-09 18:57:20',
                'updated_at' => '2020-10-16 10:18:13',
            ),        
        ));
    }
}
