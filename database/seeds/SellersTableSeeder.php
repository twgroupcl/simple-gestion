<?php

use Illuminate\Database\Seeder;

class SellersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sellers')->delete();
        
        \DB::table('sellers')->insert(array (
            0 => 
            array (
                'activities_data' => NULL,
                'addresses_data' => NULL,
                'banks_data' => NULL,
                'banner' => NULL,
                'cellphone' => NULL,
                'commission_enable' => 0,
                'commission_percentage' => '0.0000',
                'company_id' => 1,
                'contacts_data' => NULL,
                'created_at' => NULL,
                'custom_1' => 'ansilta',
                'custom_2' => 'ansilta',
                'deleted_at' => NULL,
                'email' => '',
                'id' => 1,
                'is_approved' => 0,
                'legal_representative_name' => 'ansilta',
                'logo' => NULL,
                'meta_description' => NULL,
                'meta_keywords' => NULL,
                'meta_title' => NULL,
                'name' => 'ansilta',
                'notes' => NULL,
                'password' => NULL,
                'payments_data' => NULL,
                'phone' => NULL,
                'privacy_policy' => NULL,
                'rejected_reason' => NULL,
                'return_policy' => NULL,
                'seller_category_id' => 20,
                'shipping_policy' => NULL,
                'shippings_data' => NULL,
                'source' => 'Admin',
                'status' => 1,
                'styles_json' => NULL,
                'uid' => '111111111',
                'updated_at' => NULL,
                'user_id' => NULL,
                'visible_name' => 'ansilta',
                'web' => NULL,
            ),
        ));
        
        
    }
}