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

Auth::routes();

Route::group(['middleware' =>'auth'],function (){

    Route::get('/', 'HomeController@index')->name('dashboard');

    Route::get('/api/users', 'UsersController@getUsers')->name('api.users');

    Route::get('/users','UsersController@index')->name('users');

    Route::post('/users', 'UsersController@store')->name('user.store');

    Route::delete('/users/{id}','UsersController@destroy')->name('user.delete');

    Route::PUT('/users/{id}','UsersController@edit')->name('user.edit');

    Route::patch('/users/{id}','UsersController@update')->name('user.update');


    Route::get('/user/profile/{id}',[
        'uses' => 'ProfilesController@show',
        'as' => 'user.profile'
    ]);



});





