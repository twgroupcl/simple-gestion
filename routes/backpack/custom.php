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
}); // this should be the absolute last line of this file
