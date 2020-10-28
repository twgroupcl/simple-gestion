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

Route::get('/', 'Frontend\HomeController@index')->name('index');

Route::get('/customer/sign', 'Frontend\CustomerController@sign')->name('customer.sign');
Route::post('/customer/register', 'Frontend\CustomerController@store')->name('customer.frontend.store');
Route::post('/customer/login', 'Frontend\CustomerController@authenticate')->name('customer.frontend.login');
Route::post('/customer/logout', 'Frontend\CustomerController@logout')->name('logout');
Route::get('/customer/forget', 'Frontend\CustomerController@forget')->name('customer.forget');
Route::post('/customer/recovery', 'Frontend\CustomerController@recovery')->name('customer.frontend.recovery');
Route::get('/customer/exit', 'Frontend\CustomerController@logout')->name('exit');

Route::middleware(['auth'])->group(function () {
    Route::put('/customer/{customer}', 'Frontend\CustomerController@update')->name('customer.update');
    Route::get('/customer/profile', 'Frontend\CustomerController@profile')->name('customer.profile');
    Route::get('/customer/address', 'Frontend\CustomerController@address')->name('customer.address');
    Route::get('/customer/order', 'Frontend\CustomerController@order')->name('customer.order');

    Route::put('/address/{customer}', 'Frontend\AddressController@store')->name('address.update');
});

Route::get('/seller/register', 'Frontend\SellerController@index')->name('seller.sign');
Route::post('/seller/register', 'Frontend\SellerController@store')->name('seller.frontend.store');

Route::get('/home', 'Frontend\HomeController@index')->name('home');

Route::get('/product/{slug}', 'Frontend\HomeController@productDetail')->name('product');
Route::get('/search-products/{category}/{product}', 'Frontend\HomeController@searchProduct');
Route::get('/search-products/{category}', 'Frontend\HomeController@getProductsByCategory');
Route::get('/shop-list/', function () {
    return view('shop-list');
});
Route::get('/shop-grid/', 'Frontend\HomeController@getAllProducts');
Route::get('/seller-shop/{id}', 'Frontend\HomeController@getSeller');
Route::get('/faq', 'Frontend\HomeController@getFaq');
Route::get('/faq-single', function () { 
    return view('faq-single');
});
Route::get('/faq-request', function () { 
    return view('faq-request');
});
Route::get('/privacy', function () { 
    return view('privacy');
});
Route::get('/terms-conditions', function () { 
    return view('terms-conditions');
});

//Auth::routes();
Route::redirect('/login', '/customer/login')->name('login');

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
