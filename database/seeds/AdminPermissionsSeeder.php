<?php

use Illuminate\Database\Seeder;

class AdminPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('permissions')->insert(array (
            0 => 
            array (
                'name'       => 'product.admin',
                'guard_name'   => 'web',
            ),
            1 => 
            array (
                'name'       => 'seller.admin',
                'guard_name'   => 'web',
            ),
            2 => 
            array (
                'name'       => 'communeshippingmethod.admin',
                'guard_name'   => 'web',
            ),
            3 => 
            array (
                'name'       => 'order.admin',
                'guard_name'   => 'web',
            ),
        ));        
    }
}
