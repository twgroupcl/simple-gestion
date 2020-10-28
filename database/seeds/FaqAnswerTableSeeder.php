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
                'question' => '¿QUÉ ES CONTIGOPYME?',
                'answer' => 'Somos un Marketlpace de la Cámara Regional del Comercio de Valparaíso, con apoyo de Corfo y que busca apoyar a los negocios de la Región de Valparaíso entregándoles las herramientas para crecer a través de una novedosa plataforma e-commerce.',
                'id_topic' => '1',
                'slug' => 'faq-1',
                'status' => 1,
                'created_at' => '2020-10-09 18:57:20',
                'updated_at' => '2020-10-16 10:18:13',
            ),
            1 => 
            array (
                'id' => 2,
                'question' => '¿CUÁL ES LA DIFERENCIA ENTRE UN EVENTO CYBER Y UN MARKETPLACE?',
                'answer' => 'Un Cyber un evento online con una duración definida que reúne en un sitio directorio a diversas marcas con sus respectivos logos y enlaces que direccionan a sus propios sitios e-commerce, en cambio, un Marketplace es una gran tienda de tiendas, es una plataforma dónde las empresas ofrecen sus productos y servicios, del mismo modo que lo hacen los centros comerciales con productos y servicios de las tiendas físicas.',
                'id_topic' => '2',
                'slug' => 'faq-2',
                'status' => 1,
                'created_at' => '2020-10-09 18:57:20',
                'updated_at' => '2020-10-16 10:18:13',
            ),
            2 => 
            array (
                'id' => 3,
                'question' => '¿QUIÉNES PUEDEN SER PARTE DE CONTIGOPYME?',
                'answer' => 'Pueden participar todos los pequeños o medianos negocios de la Región de Valparaíso de distintos rubros.',
                'id_topic' => '3',
                'slug' => 'faq-3',
                'status' => 1,
                'created_at' => '2020-10-09 18:57:20',
                'updated_at' => '2020-10-16 10:18:13',
            ),
            3 => 
            array (
                'id' => 4,
                'question' => '¿QUIÉN ORGANIZA?',
                'answer' => 'CONTIGOPYME es organizado por la Cámara Regional del Comercio de Valparaíso y cuenta con el apoyo de Corfo.',
                'id_topic' => '4',
                'slug' => 'faq-4',
                'status' => 2,
                'created_at' => '2020-10-09 18:57:20',
                'updated_at' => '2020-10-16 10:18:13',
            ),
            4 => 
            array (
                'id' => 5,
                'question' => '¿CÓMO COMPRAR EN CONTIGOPYME?',
                'answer' => 'Se podrá comprar a través del portal www.contigopyme.cl donde se exhibirán los productos de las marcas participantes y podrás hacerlo con tarjetas de crédito, débito y tarjetas comerciales asociadas a Transbank.',
                'id_topic' => '5',
                'slug' => 'faq-5',
                'status' => 1,
                'created_at' => '2020-10-09 18:57:20',
                'updated_at' => '2020-10-16 10:18:13',
            ),        
        ));
    }
}
