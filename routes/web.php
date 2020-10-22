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

Route::get('/customer/sign', 'Frontend\CustomerController@sign')->name('customer.sign');
Route::post('/customer/register', 'Frontend\CustomerController@store')->name('customer.frontend.store');
Route::post('/customer/login', 'Frontend\CustomerController@authenticate')->name('customer.frontend.login');
Route::post('/customer/logout', 'Frontend\CustomerController@logout')->name('logout');
Route::get('/customer/forget', 'Frontend\CustomerController@forget')->name('customer.forget');
Route::post('/customer/recovery', 'Frontend\CustomerController@recovery')->name('customer.frontend.recovery');

Route::get('/customer/profile', 'Frontend\CustomerController@profile')->name('customer.profile');
Route::get('/customer/address', 'Frontend\CustomerController@address')->name('customer.address');
Route::get('/customer/order', 'Frontend\CustomerController@order')->name('customer.order');

Route::get('/seller/register', 'Frontend\SellerController@index')->name('seller.sign');
Route::post('/seller/register', 'Frontend\SellerController@store')->name('seller.frontend.store');

Route::get('/product/{slug}', 'Frontend\HomeController@productDetail')->name('product');
Route::get('/shop-list/', function () {
    return view('shop-list');
});

//Auth::routes();

Route::get('/home', 'Frontend\HomeController@index')->name('home');
