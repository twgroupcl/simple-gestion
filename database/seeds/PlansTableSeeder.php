<?php

use Illuminate\Database\Seeder;

class PlansTableSeeder extends Seeder
{
<<<<<<< HEAD

    /**
     * Auto generated seed file
=======
    /**
     * Run the database seeds.
>>>>>>> 138c23422cbc0064424faee7a64cda09e0f10364
     *
     * @return void
     */
    public function run()
    {
<<<<<<< HEAD
        

=======
>>>>>>> 138c23422cbc0064424faee7a64cda09e0f10364
        \DB::table('plans')->delete();
        
        \DB::table('plans')->insert(array (
            0 => 
            array (
                'id' => 1,
<<<<<<< HEAD
                'slug' => 'socios-crcp',
                'name' => 'SOCIOS CRCP',
                'description' => NULL,
                'is_active' => 1,
                'price' => '0.00',
                'signup_fee' => '0.00',
                'currency' => '1',
                'trial_period' => 0,
                'trial_interval' => 'day',
                'invoice_period' => 0,
                'invoice_interval' => 'month',
                'grace_period' => 0,
                'grace_interval' => 'day',
                'prorate_day' => 0,
                'prorate_period' => 0,
                'prorate_extend_due' => 0,
                'active_subscribers_limit' => NULL,
                'sort_order' => 0,
                'created_at' => '2020-11-09 16:58:03',
                'updated_at' => '2020-11-09 16:58:03',
=======
                'slug' => 'plan-semanal',
                'name' => 'Plan Semanal',
                'price' => 50,
                'currency' => 'USD',
                'invoice_interval' => 'week',
                'created_at' => '2020-10-14 17:22:07',
                'updated_at' => '2020-10-14 17:22:07',
>>>>>>> 138c23422cbc0064424faee7a64cda09e0f10364
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
<<<<<<< HEAD
                'slug' => 'no-socios',
                'name' => 'NO SOCIOS',
                'description' => NULL,
                'is_active' => 1,
                'price' => '25000.00',
                'signup_fee' => '0.00',
                'currency' => '1',
                'trial_period' => 0,
                'trial_interval' => 'day',
                'invoice_period' => 0,
                'invoice_interval' => 'month',
                'grace_period' => 0,
                'grace_interval' => 'day',
                'prorate_day' => 0,
                'prorate_period' => 0,
                'prorate_extend_due' => 0,
                'active_subscribers_limit' => NULL,
                'sort_order' => 0,
                'created_at' => '2020-11-09 16:58:16',
                'updated_at' => '2020-11-09 16:58:16',
=======
                'slug' => 'plan-mensual',
                'name' => 'Plan Mensual',
                'price' => 100,
                'currency' => 'USD',
                'invoice_interval' => 'month',
                'created_at' => '2020-10-14 17:22:07',
                'updated_at' => '2020-10-14 17:22:07',
>>>>>>> 138c23422cbc0064424faee7a64cda09e0f10364
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
<<<<<<< HEAD
                'slug' => 'emprendedores',
                'name' => 'EMPRENDEDORES',
                'description' => NULL,
                'is_active' => 1,
                'price' => '12500.00',
                'signup_fee' => '0.00',
                'currency' => '1',
                'trial_period' => 0,
                'trial_interval' => 'day',
                'invoice_period' => 0,
                'invoice_interval' => 'month',
                'grace_period' => 0,
                'grace_interval' => 'day',
                'prorate_day' => 0,
                'prorate_period' => 0,
                'prorate_extend_due' => 0,
                'active_subscribers_limit' => NULL,
                'sort_order' => 0,
                'created_at' => '2020-11-09 16:58:30',
                'updated_at' => '2020-11-09 16:58:30',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}
=======
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
>>>>>>> 138c23422cbc0064424faee7a64cda09e0f10364
