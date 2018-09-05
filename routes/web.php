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


    Route::get('/user/edit/{id}',[
        'uses' => 'UsersController@edit',
        'as' => 'user.edit'
    ]);

    Route::post('/user/update/{id}',[
        'uses' => 'UsersController@update',
        'as' => 'user.update'
    ]);


    Route::get('/users',[
        'uses' => 'UsersController@index',
        'as' => 'users'
    ]);

    Route::post('/users',[
        'uses' => 'UsersController@store',
        'as' => 'user.store'
    ]);

    Route::get('/user/delete/{id}',[
        'uses' => 'UsersController@destroy',
        'as' => 'user.delete'

    ]);

    Route::get('/user/profile/{id}',[
        'uses' => 'ProfilesController@show',
        'as' => 'user.profile'
    ]);



});





