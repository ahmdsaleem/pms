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

    Route::get('/user/create',[
        'uses' => 'UsersController@create',
        'as' => 'user.create'
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


    Route::get('/api/users', 'UsersController@getUsers')->name('api.users');

});





