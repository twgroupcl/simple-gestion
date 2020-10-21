<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('country', 'CountryCrudController');
    Route::crud('region', 'RegionCrudController');
    Route::crud('province', 'ProvinceCrudController');
    Route::crud('commune', 'CommuneCrudController');
    Route::crud('currency', 'CurrencyCrudController');
    Route::crud('businessactivity', 'BusinessActivityCrudController');
    Route::crud('tax', 'TaxCrudController');
    Route::crud('invoicetype', 'InvoiceTypeCrudController');
    Route::crud('unit', 'UnitCrudController');
    Route::crud('company', 'CompanyCrudController');
    Route::crud('branch', 'BranchCrudController');
    Route::crud('attributemodule', 'AttributeModuleCrudController');
    Route::crud('attributefamily', 'AttributeFamilyCrudController');
    Route::crud('attribute', 'AttributeCrudController');
    Route::crud('attributegroup', 'AttributeGroupCrudController');
    Route::crud('customer', 'CustomerCrudController');
    Route::crud('companyuser', 'CompanyUserCrudController');
    Route::crud('branchcompany', 'BranchCompanyCrudController');
    Route::crud('branchuser', 'BranchUserCrudController');
    Route::get('set_current_branch/{branch_id}', function($branch_id) {
        $user = backpack_user()->set_current_branch($branch_id);

        return redirect()->route('backpack.dashboard');
    })->name('set_current_branch');
    Route::crud('customersegment', 'CustomerSegmentCrudController');
    Route::crud('bank', 'BankCrudController');
    Route::crud('bankaccounttype', 'BankAccountTypeCrudController');
    Route::crud('contacttype', 'ContactTypeCrudController');
    Route::crud('sellercategory', 'SellerCategoryCrudController');
    Route::crud('seller', 'SellerCrudController');
    Route::crud('productbrand', 'ProductBrandCrudController');
    Route::crud('productcategory', 'ProductCategoryCrudController');
    Route::crud('producttype', 'ProductTypeCrudController');
    Route::crud('productclass', 'ProductClassCrudController');
    Route::crud('productclassattribute', 'ProductClassAttributeCrudController');
    Route::crud('product', 'ProductCrudController');
    Route::crud('productinventorysource', 'ProductInventorySourceCrudController');
    Route::crud('productinventory', 'ProductInventoryCrudController');
    Route::crud('shippingmethod', 'ShippingMethodCrudController');
    Route::crud('paymentmethod', 'PaymentMethodCrudController');
    Route::crud('quotation', 'QuotationCrudController');
    Route::post('quotation/addresses', 'QuotationCrudController@addresses');

     // API routes
     Route::get('api/productclass/get', 'ProductClassCrudController@searchProductClasses');
     Route::get('api/productclassattributes/get', 'ProductClassAttributeCrudController@searchConfigurableAttributes');
}); // this should be the absolute last line of this file
