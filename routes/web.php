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

    // :TODO here routs
});

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/products', 'HomeController@showStoreProducts');
Route::get('/home/brands', 'HomeController@showStoreBrands')->name('home.brands');
Route::get('/home/compare', 'HomeController@compareProducts');
Route::get('/home/{supplier}', 'SupplierController@index')->where('supplier', 'supplier[0-9]+');
# :TODO rename
Route::get('/home/show/{supplier}', 'SupplierController@showSupplier')->where('supplier', 'supplier[0-9]+');

//import from suppliers
Route::get('/import/{supplier}', 'ImportController@importSupplierData')->where('supplier', 'supplier[0-9]+');

//products from store
Route::get('/store/products', 'ImportController@importStoreProducts');
// brands
Route::get('/store/brands', 'ImportController@importStoreBrands');