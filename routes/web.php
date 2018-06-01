<?php

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::group(['prefix'=>'admin', 'namespace'=>'Admin', 'middleware'=>['auth']], function(){
    Route::group(['prefix' => 'user_managment', 'namespace' => 'UserManagment'], function(){
        Route::resource('/user', 'UserController', ['as'=>'admin.user_managment']);
    });
});

Route::group(['middleware' => ['auth']], function () {

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/home/products', 'HomeController@showStoreProducts');
    Route::get('/home/brands', 'HomeController@showStoreBrands')->name('home.brands');
    Route::get('/home/compare', 'HomeController@compareProducts');
    Route::get('/home/{supplier}', 'SupplierController@index')->where('supplier', 'supplier[0-9]+');
    Route::get('/home/show/{supplier}', 'SupplierController@showSupplier')->where('supplier', 'supplier[0-9]+'); # :TODO rename
    //import from suppliers
    Route::get('/import/{supplier}', 'ImportController@importSupplierProducts')->where('supplier', 'supplier[0-9]+');
    //import from store
    Route::get('/store/products', 'ImportController@importStoreProducts');
    Route::get('/store/brands', 'ImportController@importStoreBrands');

    Route::post('/sync', 'SyncController@sync')->name('sync.product');
    Route::post('/create-product', 'SyncController@createProduct');
    Route::delete('/delete-product', 'SyncController@deleteProduct');
});