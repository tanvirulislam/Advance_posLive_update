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

Route::get('/clear', function() {
    
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    \Illuminate\Support\Facades\Artisan::call('config:clear');
    \Illuminate\Support\Facades\Artisan::call('config:cache');
    \Illuminate\Support\Facades\Artisan::call('view:clear');
    \Illuminate\Support\Facades\Artisan::call('route:clear');
    return 'Cleared!';
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['as'=>'admin.','prefix'=>'admin','namespace'=>'Admin','middleware'=>['auth','admin']], function (){

	Route::get('dashboard','DashboardController@index')->name('dashboard');
    Route::get('settings','SettingController@index')->name('settings');
    Route::put('profile-update/{id}','SettingController@updateProfile')->name('profile.update');
    Route::put('password-update','SettingController@updatePassword')->name('password.update');
    // product
    Route::get('product', 'ProductController@index')->name('product');
    Route::get('product/create', 'ProductController@create')->name('product.create');
    Route::post('product/store', 'ProductController@store')->name('product.store');
    Route::post('product/edit/', 'ProductController@edit')->name('product.edit');
    Route::post('product/update/', 'ProductController@update')->name('product.update');
    Route::post('product/view/', 'ProductController@view')->name('product.view');
    Route::delete('product/delete/{id}', 'ProductController@delete')->name('product.delete');
    // supplier
    Route::get('supplier', 'SupplierController@index')->name('supplier');
    Route::get('supplier/create', 'SupplierController@create')->name('supplier.create');
    Route::post('supplier/store', 'SupplierController@store')->name('supplier.store');
    Route::post('supplier/edit/', 'SupplierController@edit')->name('supplier.edit');
    Route::post('supplier/update/', 'SupplierController@update')->name('supplier.update');
    Route::post('supplier/view/', 'SupplierController@view')->name('supplier.view');
    Route::delete('supplier/delete/{id}', 'SupplierController@delete')->name('supplier.delete');

    // Category
    Route::post('category/store', 'CategoryController@store')->name('category.store');

    // Subcategpry
    Route::post('subcategory/store', 'SubcategoryController@store')->name('subcategory.store');

    // Brand
    Route::post('brand/store', 'BrandController@store')->name('brand.store');

    //Unit
    Route::post('unit/store', 'UnitController@store')->name('unit.store');

    // LowStock
    Route::get('/low-stock-products','StockController@lowStockProduct')->name('stock.lowStockProduct');
    Route::get('/add-lowStock-to-purchase/{id}', 'ProductController@addStock')->name('stock.lowStock.addStock');

    //ajax subcategoru select  
    Route::post('/select-sub-Category', 'SubcategoryController@selectSubcategory')->name('subcategory.selectSubcategory');

    // Purchase
    Route::get('purchase', 'PurchaseController@index')->name('purchase');
    Route::get('purchase/create', 'PurchaseController@create')->name('purchase.create');
    Route::post('purchase/store', 'PurchaseController@store')->name('purchase.store');
    Route::get('purchase/edit/{id}', 'PurchaseController@edit')->name('purchase.edit');
    Route::put('purchase/update/{id}', 'PurchaseController@update')->name('purchase.update');
    Route::delete('purchase/delete/{id}', 'PurchaseController@delete')->name('purchase.delete');
    Route::post('purchase-details', 'PurchaseController@purchaseDetails')->name('purchase.purchaseDetails');
    // purchase ajax
    Route::post('/add-product-to-purchase', 'PurchaseController@productAddTopurchase')->name('purchase.productAddToPurchase');
    Route::post('/update-purchase-Qty', 'PurchaseController@updateQty')->name('purchase.updateQty');
    Route::get('/remove-item/{id}', 'PurchaseController@removeItem')->name('purchase.removeItem');
    Route::get('/remove-all', 'PurchaseController@removeAllItem')->name('purchase.removeAllItem');

    // PosSale
    Route::get('sale-pos', 'PossaleController@index')->name('sale-pos');
    Route::get('sale-pos/create', 'PossaleController@create')->name('sale-pos.create');
    Route::post('sale-pos/store', 'PossaleController@store')->name('sale-pos.store');
    Route::get('sale-pos/edit/{id}', 'PossaleController@edit')->name('sale-pos.edit');
    Route::put('sale-pos/update/{id}', 'PossaleController@update')->name('sale-pos.update');
    Route::delete('sale/delete/{id}', 'PossaleController@delete')->name('sale-pos.delete');

    Route::post('pos-setCustomer', 'PossaleController@setCustomer')->name('pos.setCustomer');
    Route::post('pos-customerReset', 'PossaleController@customerReset')->name('pos.customerReset');
    Route::post('/add-customer', 'PossaleController@addCustomer')->name('pos.addCustomer');
    Route::post('/customer-details', 'PossaleController@CustomerDetails')->name('pos.CustomerDetails');

    Route::post('/brand-products', 'PossaleController@searchProductByBrandId')->name('pos.searchProductByBrandId');
    Route::post('/category-products', 'PossaleController@searchProductByCatId')->name('pos.searchProductByCatId');
    Route::post('/sub-category-products', 'PossaleController@searchProductBySubcatId')->name('pos.searchProductBySubcatId');

    Route::post('/search-product', 'PossaleController@searchProduct')->name('pos.searchProduct');
    Route::post('/add-to-cart', 'PossaleController@addToCart')->name('pos.addToCart');
    Route::post('pos-product-save', 'PossaleController@productSave')->name('pos.productSave');
    
    Route::post('/update-Qty', 'PossaleController@updateQty')->name('pos.updateQty');
    Route::post('get-product-info', 'PossaleController@getProductInfo')->name('pos.getProductInfo');
    Route::post('/update-tax', 'PossaleController@updateTax')->name('pos.updateTax');
    Route::post('/update-discount', 'PossaleController@updateDiscount')->name('pos.updateDiscount');

    Route::post('/remove-item-from-pos', 'PossaleController@removeItem')->name('pos.removeItem');

    Route::post('pos-product-info-update', 'PossaleController@productInfoUpdate')->name('pos.productInfoUpdate');

    Route::get('bill-view/{id}', 'PossaleController@billView')->name('pos.billView');
    Route::post('/bill-preview', 'PossaleController@billPreview')->name('pos.billPreview');
    Route::post('/payment-screen', 'PossaleController@paymentScreen')->name('pos.paymentScreen');
    Route::post('/make-invoice', 'PossaleController@makeInvoice')->name('pos.makeInvoice');

    Route::post('/customer-details', 'PossaleController@CustomerDetails')->name('pos.CustomerDetails');







	 });

Route::group(['as'=>'user.','prefix'=>'user','namespace'=>'User','middleware'=>['auth','user']], function (){

	Route::get('dashboard','DashboardController@index')->name('dashboard');
    Route::get('settings','SettingController@index')->name('settings');
    Route::put('profile-update/{id}','SettingController@updateProfile')->name('profile.update');
    Route::put('password-update','SettingController@updatePassword')->name('password.update');

	 });

Route::group(['as'=>'agent.','prefix'=>'agent','namespace'=>'Agent','middleware'=>['auth','agent']], function (){

	Route::get('dashboard','DashboardController@index')->name('dashboard');
    Route::get('settings','SettingController@index')->name('settings');
    Route::put('profile-update/{id}','SettingController@updateProfile')->name('profile.update');
    Route::put('password-update','SettingController@updatePassword')->name('password.update');

	 });

Route::group(['as'=>'merchant.','prefix'=>'merchant','namespace'=>'Merchant','middleware'=>['auth','merchant']], function (){

	Route::get('dashboard','DashboardController@index')->name('dashboard');
    Route::get('settings','SettingController@index')->name('settings');
    Route::put('profile-update/{id}','SettingController@updateProfile')->name('profile.update');
    Route::put('password-update','SettingController@updatePassword')->name('password.update');

	 });

Route::group(['as'=>'vip.','prefix'=>'vip','namespace'=>'Vip','middleware'=>['auth','vip']], function (){

	Route::get('dashboard','DashboardController@index')->name('dashboard');
    Route::get('settings','SettingController@index')->name('settings');
    Route::put('profile-update/{id}','SettingController@updateProfile')->name('profile.update');
    Route::put('password-update','SettingController@updatePassword')->name('password.update');

	 });