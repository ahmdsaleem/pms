<?php


Auth::routes();

Route::group(['middleware' =>'auth'],function () {

    Route::get('/', 'HomeController@index')->name('dashboard');

    Route::get('/products','ProductsController@index')->name('products');

    Route::get('/api/products', 'ProductsController@getProducts')->name('api.products');

    Route::post('/products', 'ProductsController@store')->name('product.store');

    Route::PUT('/products/{id}','ProductsController@edit')->name('product.edit');

    Route::patch('/products/{id}','ProductsController@update')->name('product.update');

    Route::delete('/products/{id}','ProductsController@destroy')->name('product.delete');

});


Route::group(['middleware' =>['auth','admin']],function (){

    Route::get('/api/users', 'UsersController@getUsers')->name('api.users');

    Route::get('/users','UsersController@index')->name('users');

    Route::post('/users', 'UsersController@store')->name('user.store');

    Route::PUT('/users/{id}','UsersController@edit')->name('user.edit');

    Route::patch('/users/{id}','UsersController@update')->name('user.update');

    Route::delete('/users/{id}','UsersController@destroy')->name('user.delete');

});


Route::get('/test',function ()
{
    
});

