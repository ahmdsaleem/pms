<?php

namespace App\Http\Controllers;

use App\User;
use App\Classes\Response;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    const MODULE = 'user';

    public function index()
    {
        return view('users.index');
    }

    public function store(Request $request)
    {
        $response=new Response();

        try {

            $this->validate($request, [
                'username'=> 'required',
                'email'=> 'required | email',
                'password' => 'required'
            ]);

            $user = User::create([
                'name' => $request->get('username'),
                'email' => $request->get('email'),
                'password' => bcrypt($request->get('password')),
            ]);

            $response->setResponse(true, 200, 'auth'.'.'.SELF::MODULE . '.' . '200');
        }
        catch(\Exception $e)
        {
            $response->setResponse(false, 400, 'auth'.'.'.SELF::MODULE . '.' . '400');
        }


        return response()->json([
            'success' => $response->getStatus(),
            'code' => $response->getCode(),
            'message' => $response->getMessage()
        ]);
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);
        return $user;
    }

    public function update(Request $request, $id)
    {
        $response=new Response();
        try {

            $this->validate($request, [
                'username'=> 'required',
                'email'=> 'required | email',
            ]);

            $user = User::findOrFail($id);
            $user->name = $request->get('username');
            $user->email = $request->get('email');
            $password = $request->get('password');
            if (!empty($password)) {
                $user->password = bcrypt($password);
            }
            $user->save();
            $response->setResponse(true, 200, 'auth'.'.'.SELF::MODULE . '.' . '200');
            }
            catch (\Exception $ex)
            {
                $response->setResponse(false, 400, 'auth'.'.'.SELF::MODULE . '.' . '400');
            }

        return response()->json([
            'success' => $response->getStatus(),
            'code' => $response->getCode(),
            'message' => $response->getMessage()
        ]);
    }


    public function destroy($id)
    {
        $response=new Response();
        try {
            $user = User::findOrFail($id);
            User::destroy($id);
            $response->setResponse(true, 200, 'auth'.'.'.SELF::MODULE . '.' . '200');
        }
        catch (\Exception $ex)
        {
            $response->setResponse(false, 400, 'auth'.'.'.SELF::MODULE . '.' . '400');
        }

        return response()->json([
            'success' => $response->getStatus(),
            'code' => $response->getCode(),
            'message' => $response->getMessage()
        ]);

    }

    public function getUsers(Request $request)
    {

        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $search['value']=true;

        $users = User::skip($start)->take($length)->get();
        $total_users= User::all()->count();

        $parameters=array();
        $parameters['draw']=$draw;
        $parameters['recordsTotal']=$total_users;
        $parameters['recordsFiltered']=$total_users;

        foreach ($users as $user)
        {
            $user['action']='<a onclick="editUser('.$user->id.')"> <l title="Edit User Details" style="margin:10px" class="fa fa-pencil-square-o"></l> </a>'.
                '<a onclick="deleteUser('.$user->id.')"> <l title="Delete User" style="margin:10px" class="font-icon font-icon-trash"></l></a>';
        }

        $parameters['data']=$users;
        $parameters['input']=array();
        return $parameters;

    }

}
