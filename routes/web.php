<?php


Auth::routes();

Route::group(['middleware' =>'auth'],function () {

    Route::get('/', 'HomeController@index')->name('dashboard');

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
    $users = \App\User::all();
    $parameters=array();
    $parameters['draw']=0;
    $parameters['recordsTotal']=count($users);
    $parameters['recordsFiltered']=count($users);

    foreach ($users as $user)
    {
        $user['action']='<a onclick="editUser('.$user->id.')"> <l title="Edit User Details" style="margin:10px" class="fa fa-pencil-square-o"></l> </a onclick="editUser('.$user->id.')">'.
            '<a onclick="deleteUser('.$user->id.')"> <l title="Delete User" style="margin:10px" class="font-icon font-icon-trash"></l></a>';
    }

    $parameters['data']=$users;
    $parameters['input']=array();
    return $parameters;


});


Route::get('/datatableformat',function ()
{
    $users = \App\User::all();
    return datatables($users)
        ->addColumn('action',function($user)
        {
            return '<a onclick="editUser('.$user->id.')"> <l title="Edit User Details" style="margin:10px" class="fa fa-pencil-square-o"></l> </a>'.
                '<a onclick="deleteUser('.$user->id.')"> <l title="Delete User" style="margin:10px" class="font-icon font-icon-trash"></l></a>';
        })->make(true);;

});

