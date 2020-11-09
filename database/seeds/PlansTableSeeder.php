<?php

use Illuminate\Database\Seeder;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('plans')->delete();
        
        \DB::table('plans')->insert(array (
            0 => 
            array (
                'id' => 1,
                'slug' => 'plan-semanal',
                'name' => 'Plan Semanal',
                'price' => 50,
                'currency' => 'USD',
                'invoice_interval' => 'week',
                'created_at' => '2020-10-14 17:22:07',
                'updated_at' => '2020-10-14 17:22:07',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'slug' => 'plan-mensual',
                'name' => 'Plan Mensual',
                'price' => 100,
                'currency' => 'USD',
                'invoice_interval' => 'month',
                'created_at' => '2020-10-14 17:22:07',
                'updated_at' => '2020-10-14 17:22:07',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'slug' => 'plan-mensual-especial',
                'name' => 'Plan Mensual Especial',
                'price' => 150,
                'currency' => 'USD',
                'invoice_interval' => 'month',
                'created_at' => '2020-10-14 17:22:07',
                'updated_at' => '2020-10-14 17:22:07',
                'deleted_at' => NULL,
            ),
        ));
    }
}
