<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


/********************************************
 * 
 *  API
 *  V1
 * 
 *******************************************/

Route::group([ 'prefix' => '/v1'], function() {

    // Login
    Route::post('/login', 'Api\v1\AuthController@authenticate');
    Route::get('/test', 'Api\v1\AuthController@test')->middleware('auth.jwt');;


    // Product Brand
    Route::post('/product-brands', 'Api\v1\ProductBrandController@store')
        ->middleware(['auth.jwt', 'permission:productbrand.create'])
        ->name('api.product-brand.post');
    Route::get('/product-brands/{id}', 'Api\v1\ProductBrandController@show')
        ->name('api.brand.show');
    Route::get('/product-brands', 'Api\v1\ProductBrandController@all')
        ->name('api.brand.all');


    // Product Category
    Route::post('/product-categories', 'Api\v1\ProductCategoryController@store')
        ->middleware(['auth.jwt', 'permission:productcategory.create'])
        ->name('api.product-category.post');
    Route::get('/product-categories/{id}', 'Api\v1\ProductCategoryController@show')
        ->name('api.product-category.show');
    Route::get('/product-categories', 'Api\v1\ProductCategoryController@all')
        ->name('api.product-category.all');
});

