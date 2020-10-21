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
Route::post('/customer', 'Frontend\CustomerController@store');
Route::post('/login-customer', 'Frontend\CustomerController@authenticate');

Route::get('/seller/register', 'Frontend\SellerController@index');
Route::post('/seller/register', 'Frontend\SellerController@store')->name('seller.frontend.store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
