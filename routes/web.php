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


Route::get('/blog/category/{slug?}', 'BlogController@category')->name('category');
Route::get('/blog/article/{slug?}', 'BlogController@article')->name('article');

Route::group(['prefix'=>'admin', 'namespace'=>'Admin', 'middleware'=>['auth']], function(){
    Route::get('/', 'DashboardController@dashboard')->name('admin.index');  //сюда втулить ссылки
    Route::resource('/category', 'CategoryController', ['as'=>'admin']); // products
    Route::resource('/brands', 'CategoryController', ['as'=>'admin']); // brands
    Route::resource('/article', 'ArticleController', ['as'=>'admin']);  // suppliers
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
Route::get('/home/brands', 'BrandController@index')->name('home.brands');

//import from suppliers
Route::get('/import/{supplier}', 'ImportController@import');

//brands from store
Route::get('/store/brands', 'StoreController@getAllBrands');

//products from store
Route::get('/store/products', 'StoreController@importProducts');