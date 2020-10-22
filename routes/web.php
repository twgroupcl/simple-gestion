<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return redirect(backpack_url('dashboard'));
// });

Route::get('/', 'Frontend\HomeController@index');

Route::get('/seller/register', 'Frontend\SellerController@index');
Route::post('/seller/register', 'Frontend\SellerController@store')->name('seller.frontend.store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/shopping-cart', 'Frontend\CartController@shoppingCart')->name('shopping-cart');
Route::get('/checkout', 'Frontend\CheckoutController@index')->name('checkout');


Route::group([
    'prefix' => '/transbank'
], function () {
    Route::get('main', function(){
        return view('payments.transbank.test');
    });

    // WebPayPlus Mall
    Route::get('webpay/mall/{order}', 'Payments\Transbank\WebpayPlusMallController@redirect')->name('transbank.webpayplus.mall.redirect');
    Route::post('webpay/mall/response', 'Payments\Transbank\WebpayPlusMallController@response')->name('transbank.webpayplus.mall.response');
    Route::get('webpay/mall/download/{order}', 'Payments\Transbank\WebpayPlusMallController@download')->name('transbank.webpayplus.mall.download');
});
// Route::get('complete', function(){
//     return view('payments.transbank.webpay.mall.complete');
// });
