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


    public function create()
    {
        return view('users.create');
    }


    public function store(Request $request)
    {
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
        //
    }

    public function update(Request $request, $id)
    {
        //
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
                return '<button onclick="editUser('.$user->id.')"> Edit </button>'.
                        '<button onclick="deleteUser('.$user->id.')"> Delete </button>';
            })->make(true);

    }

}
