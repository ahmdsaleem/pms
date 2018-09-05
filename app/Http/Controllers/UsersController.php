<?php

namespace App\Http\Controllers;

use App\User;
use App\Profile;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        return view('users.index');
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'password' =>'required'
        ]);

        $user=User::create([
            'name' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $profile = Profile::create([
            'user_id' => $user->id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User Created'
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


        $user = User::find($id);
        $user->name=$request->username;
        $user->email=$request->email;
        $password= $request->get('password');
        if(!empty($password)) {
            $user->password = bcrypt($request->password);
        }
        $user->save();
        return response()->json([
            'success' => true,
            'message' => 'User Updated'
        ]);
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);

        User::destroy($id);

        return response()->json([
            'success' => true,
            'message' => 'User Deleted'
        ]);

    }

    public function getUsers()
    {
        $user = User::all();
        return datatables($user)
            ->addColumn('action',function($user)
            {
                return '<a onclick="editUser('.$user->id.')"> <l title="Edit User Details" style="margin:10px" class="fa fa-pencil-square-o"></l> </a>'.
                        '<a onclick="deleteUser('.$user->id.')"> <l title="Delete User" style="margin:10px" class="font-icon font-icon-trash"></l></a>';
            })->make(true);

    }

}
