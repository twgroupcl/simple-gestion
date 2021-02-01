<?php

namespace App\Http\Controllers\Api\v1;

use App\User;
use App\Models\Cart;
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

    // Temporal method
    // Only for testing
    public function reset()
    {
        DB::beginTransaction();

        try {
            $cartItems = CartItem::all();
            foreach ($cartItems as $cartItem) {
                $cartItem->forceDelete();
            }

            $carts = Cart::all();
            foreach ($carts as $cart) {
                $cart->forceDelete();
            }
            
            $products = Product::all();
            foreach ($products as $product) {
                $product->delete();
            }
            
    
            $brands = ProductBrand::all();
            foreach ($brands as $brand) {
                $brand->forceDelete();
            }
            
            $categories = ProductCategory::all();
            foreach ($categories as $categorie) {
                $classes = $categorie->product_class;
                foreach ($classes as $class) {
                    $class->category_id = null;
                    $class->save();
                }
                $categorie->forceDelete();
            }
    
            $sellers = Seller::all();
            foreach ($sellers as $seller) {
                DB::table('shipping_method_seller_mapping')->where('seller_id', $seller->id)->delete();
                DB::table('payment_method_seller_mapping')->where('seller_id', $seller->id)->delete();
                DB::table('seller_addresses')->where('seller_id', $seller->id)->delete();
                $seller->shippingmethods()->detach();
                $seller->forceDelete();
            }
    
            $warehouses = ProductInventorySource::all();
            foreach ($warehouses as $warehouse) {
                $warehouse->forceDelete();
            }
    
            $users = User::whereNotIn('id', [1, 2, 3])->get();
            foreach ($users as $user) {
                DB::table('branch_users')->where('user_id', $user->id)->delete();
                DB::table('company_users')->where('user_id', $user->id)->delete();
                $user->forceDelete();
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return $e;
        }

        DB::commit();
        return 'Reset realizado.';
    }

}