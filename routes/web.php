<?php

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


Route::group(['prefix'=>'admin', 'namespace'=>'Admin', 'middleware'=>['auth']], function(){
    Route::group(['prefix' => 'user_managment', 'namespace' => 'UserManagment'], function(){
        Route::resource('/user', 'UserController', ['as'=>'admin.user_managment']);
    });

    // here routs








});

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/products', 'StoreProductController@index');
Route::get('/home/brands', 'BrandController@index')->name('home.brands');
Route::get('/home/{supplier}', 'SupplierController@index')->where('supplier', 'supplier[0-9]+');

Route::get('/home/show/{supplier}', 'SupplierController@showSupplier')->where('supplier', 'supplier[0-9]+');



//import from suppliers
Route::get('/suppliers/{supplier}', 'ImportController@importSupplierData')->where('supplier', 'supplier[0-9]+');

//products from store
Route::get('/store/products', 'ImportController@importStoreProducts');

// brands
Route::get('/store/brands', 'ImportController@importStoreBrands');