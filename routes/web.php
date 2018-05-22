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
    return view('blog.home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/products', 'StoreProductController@index');
Route::get('/home/brands', 'BrandController@index')->name('home.brands');
Route::get('/home/supplier1', 'Supplier1Controller@index');
Route::get('/home/supplier2', 'Supplier2Controller@index');
Route::get('/home/supplier3', 'Supplier3Controller@index');
Route::get('/home/supplier4', 'Supplier4Controller@index');


Route::get('/home/show/supplier1', 'Supplier1Controller@showSupplier');
Route::get('/home/show/supplier2', 'Supplier2Controller@showSupplier');
Route::get('/home/show/supplier3', 'Supplier3Controller@showSupplier');
Route::get('/home/show/supplier4', 'Supplier4Controller@showSupplier');



//import from suppliers
Route::get('/import/{supplier}', 'ImportController@import')->where('supplier', 'supplier[0-9]+');;

//brands from store
Route::get('/store/brands', 'StoreController@getAllBrands');

//products from store
Route::get('/store/products', 'StoreController@importProducts');



// for hands
// update price
Route::get('/home/supplier1/update', 'Supplier1Controller@updatePrice');