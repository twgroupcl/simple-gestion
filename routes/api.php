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

    // Product
    Route::post('/products', 'Api\v1\ProductController@store')
        ->middleware(['auth.jwt', 'permission:product.create'])
        ->name('api.products.store');
    Route::get('/products/{id}', 'Api\v1\ProductController@show')
        ->name('api.products.show');


    // Product Brand
    Route::post('/product-brands', 'Api\v1\ProductBrandController@store')
        ->middleware(['auth.jwt', 'permission:productbrand.create'])
        ->name('api.product-brands.store');
    Route::get('/product-brands/{id}', 'Api\v1\ProductBrandController@show')
        ->name('api.product-brands.show');
    Route::get('/product-brands', 'Api\v1\ProductBrandController@all')
        ->name('api.product-brands.all');


    // Brand
    Route::post('/brands', 'Api\v1\ProductBrandController@store')
        ->middleware(['auth.jwt', 'permission:productbrand.create'])
        ->name('api.brands.store');
    Route::get('/brands/{id}', 'Api\v1\ProductBrandController@show')
        ->name('api.brands.show');
    Route::get('/brands', 'Api\v1\ProductBrandController@all')
        ->name('api.brands.all');


    // Product Category
    Route::post('/product-categories', 'Api\v1\ProductCategoryController@store')
        ->middleware(['auth.jwt', 'permission:productcategory.create'])
        ->name('api.product-categories.store');
    Route::get('/product-categories/{id}', 'Api\v1\ProductCategoryController@show')
        ->name('api.product-categories.show');
    Route::get('/product-categories', 'Api\v1\ProductCategoryController@all')
        ->name('api.product-categories.all');


    // Category
    Route::post('/categories', 'Api\v1\ProductCategoryController@store')
        ->middleware(['auth.jwt', 'permission:productcategory.create'])
        ->name('api.categories.store');
    Route::get('/categories/{id}', 'Api\v1\ProductCategoryController@show')
        ->name('api.categories.show');
    Route::get('/categories', 'Api\v1\ProductCategoryController@all')
        ->name('api.categories.all');

    
    // Product CLass
    Route::post('/product-classes', 'Api\v1\ProductClassController@store')
        ->middleware(['auth.jwt', 'permission:productclass.create'])
        ->name('api.product-classes.store');
    Route::get('/product-classes/{id}', 'Api\v1\ProductClassController@show')
        ->name('api.product-classes.show');
    Route::get('/product-classes', 'Api\v1\ProductClassController@all')
        ->name('api.product-classes.all');


    // Warehouse
    Route::get('/warehouses/{id}', 'Api\v1\ProductInventorySourceController@show')
        ->name('api.warehouses.show');
});

