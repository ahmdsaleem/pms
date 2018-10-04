<?php


    Auth::routes();

    Route::get('/', 'HomeController@index')->name('dashboard')->middleware('auth');

    //User Module Routes
    Route::group(['middleware' =>['auth','admin']],function (){


        Route::get('/api/users', 'UsersController@getUsers')->name('api.users');

        Route::get('/users','UsersController@index')->name('users');

        Route::post('/users', 'UsersController@store')->name('user.store');

        Route::PUT('/users/{id}','UsersController@edit')->name('user.edit');

        Route::patch('/users/{id}','UsersController@update')->name('user.update');

        Route::delete('/users/{id}','UsersController@destroy')->name('user.delete');

    });


//Project Module Routes

    Route::group(['middleware' =>['auth','admin']],function () {


        Route::get('/projects','ProjectsController@index')->name('projects');

        Route::get('/api/projects', 'ProjectsController@getProjects')->name('api.projects');

        Route::post('/projects', 'ProjectsController@store')->name('project.store');

        Route::PUT('/projects/{id}','ProjectsController@edit')->name('project.edit');

        Route::patch('/projects/{id}','ProjectsController@update')->name('project.update');

        Route::delete('/projects/{id}','ProjectsController@destroy')->name('project.delete');

        Route::get('/projects/platform/fields/{id}','ProjectsController@getFields');

        Route::get('/projects/{pid}/platform/{id}','ProjectsController@getFieldsWithValues');


    });

// Customer Module Routes

Route::group(['middleware' =>'auth'],function () {

    Route::get('/customers','CustomersController@index')->name('customers');

    Route::get('/api/customers', 'CustomersController@getCustomers')->name('api.customers');

    Route::post('/customers', 'CustomersController@store')->name('customer.store');

    Route::PUT('/customers/{id}','CustomersController@edit')->name('customer.edit');

    Route::patch('/customers/{id}','CustomersController@update')->name('customer.update');

    Route::delete('/customers/{id}','CustomersController@destroy')->name('customer.delete');

    Route::get('/customers/{id}','CustomersController@show')->name('customer.show');

});

// Lookups Routes Group
    Route::group(['middleware' =>'auth'],function () {

        Route::get('/lookups','LookupsController@index')->name('lookups');

        Route::get('/api/lookup/projects', 'LookupsController@getProjects');

        Route::get('/lookup/project/{id}','LookupsController@show')->name('lookup.project');

    });



Route::get('/test',function ()
{


    return \Carbon\Carbon::createFromTimestamp(1538636587)->toDateTimeString();
//    return Carbon\Carbon::parse(1538636587)->toDateTimeString();

});


    Route::post('/project/ipn/url/{id}','CustomersController@store')->name('project.ipn.url');
