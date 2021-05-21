<?php

namespace App\Http\Controllers\Api\v1;

use App\User;
use App\Models\Cart;
use App\Models\Branch;
use App\Models\Seller;
use App\Models\Product;
use App\Models\CartItem;
use App\Models\ProductBrand;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;
use App\Models\ProductInventorySource;
use App\Http\Controllers\Api\Controller;

class CompanyController extends Controller
{

    public function indexReset()
    {
        return view('company.tool-reset');
    }
    // Temporal method
    // Only for testing
    public function reset(Request $request)
    {
        if ($request['pass'] != 'adminreset') return 'Error en pass';

        DB::beginTransaction();

        try {

            DB::table('order_payments')->delete();
            DB::table('order_logs')->delete();
            DB::table('order_items')->delete();
            DB::table('order_errors_log')->delete();
            DB::table('orders')->delete();
            DB::table('cart_logs')->delete();
            DB::table('cart_payments')->delete();
            DB::table('cart_items')->delete();
            DB::table('cart_items')->delete();
            DB::table('carts')->delete();
            DB::table('product_attributes')->delete();
            DB::table('product_category_mapping')->delete();
            DB::table('product_images')->delete();
            DB::table('shipping_method_product_mapping')->delete();
            DB::table('product_super_attributes')->delete();
            DB::table('product_inventories')->delete();
            DB::table('product_inventories')->delete();
            DB::table('products')->delete();
            DB::table('product_brands')->delete();
            DB::table('product_class_attributes')->delete();
            DB::table('product_classes')->delete();
            DB::table('product_categories')->orderBy('created_at', 'DESC')->delete();
            DB::table('commune_shipping_methods')->delete();
            DB::table('shipping_method_seller_mapping')->delete();
            DB::table('payment_method_seller_mapping')->delete();
            DB::table('seller_addresses')->delete();
            DB::table('seller_notifications')->delete();
            DB::table('sellers')->delete();
            DB::table('product_inventory_sources')->delete();
            DB::table('customer_addresses')->delete();
            DB::table('customer_notifications')->delete();
            DB::table('customer_support')->delete();
            DB::table('customer_support_history')->delete();
            DB::table('customers')->delete();
            DB::table('branch_users')->whereNotIn('user_id', [1, 2, 3, 84])->delete();
            DB::table('company_users')->whereNotIn('user_id', [1, 2, 3, 84])->delete();
            DB::table('users')->whereNotIn('id', [1, 2, 3, 84])->delete();
            DB::table('branch_companies')->whereNotIn('branch_id', [1, 2])->delete();
            DB::table('branches')->whereNotIn('id', [1, 2])->delete();
        } catch (\Exception $e) {
            DB::rollBack();
            return $e;
        }

        DB::commit();
        return 'Reset realizado.';
    }

}