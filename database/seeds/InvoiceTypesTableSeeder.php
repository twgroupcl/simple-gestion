<?php

use Illuminate\Database\Seeder;

class InvoiceTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('invoice_types')->delete();
        
        \DB::table('invoice_types')->insert(array (
            0 => 
            array (
                'code' => 33,
                'country_id' => 43,
                'created_at' => '2020-08-22 10:46:36',
                'deleted_at' => NULL,
                'description' => NULL,
                'id' => 1,
                'name' => 'Factura Electrónica',
                'updated_at' => '2020-08-22 10:46:36',
            ),
            1 => 
            array (
                'code' => 34,
                'country_id' => 43,
                'created_at' => '2020-08-22 10:46:36',
                'deleted_at' => NULL,
                'description' => NULL,
                'id' => 2,
                'name' => 'Factura No Afecta o Exenta Electrónica',
                'updated_at' => '2020-08-22 10:46:36',
            ),
            2 => 
            array (
                'code' => 43,
                'country_id' => 43,
                'created_at' => '2020-08-22 10:46:36',
                'deleted_at' => NULL,
                'description' => NULL,
                'id' => 3,
                'name' => 'Liquidación-Factura Electrónica',
                'updated_at' => '2020-08-22 10:46:36',
            ),
            3 => 
            array (
                'code' => 46,
                'country_id' => 43,
                'created_at' => '2020-08-22 10:46:36',
                'deleted_at' => NULL,
                'description' => NULL,
                'id' => 4,
                'name' => 'Factura de compra electrónica',
                'updated_at' => '2020-08-22 10:46:36',
            ),
            4 => 
            array (
                'code' => 52,
                'country_id' => 43,
                'created_at' => '2020-08-22 10:46:36',
                'deleted_at' => NULL,
                'description' => NULL,
                'id' => 5,
                'name' => 'Guía de Despacho Electrónica',
                'updated_at' => '2020-08-22 10:46:36',
            ),
            5 => 
            array (
                'code' => 56,
                'country_id' => 43,
                'created_at' => '2020-08-22 10:46:36',
                'deleted_at' => NULL,
                'description' => NULL,
                'id' => 6,
                'name' => 'Nota de Débito Electrónica',
                'updated_at' => '2020-08-22 10:46:36',
            ),
            6 => 
            array (
                'code' => 61,
                'country_id' => 43,
                'created_at' => '2020-08-22 10:46:36',
                'deleted_at' => NULL,
                'description' => NULL,
                'id' => 7,
                'name' => 'Nota de Crédito Electrónica',
                'updated_at' => '2020-08-22 10:46:36',
            ),
            7 => 
            array (
                'code' => 110,
                'country_id' => 43,
                'created_at' => '2020-08-22 10:46:36',
                'deleted_at' => NULL,
                'description' => NULL,
                'id' => 8,
                'name' => 'Factura de Exportación',
                'updated_at' => '2020-08-22 10:46:36',
            ),
            8 => 
            array (
                'code' => 112,
                'country_id' => 43,
                'created_at' => '2020-08-22 10:46:36',
                'deleted_at' => NULL,
                'description' => NULL,
                'id' => 9,
                'name' => 'Nota de Crédito de Exportación',
                'updated_at' => '2020-08-22 10:46:36',
            ),
        ));
        
        
    }
}