<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Product;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index')->with('user_count',User::all()->count())
                                  ->with('product_count',Product::all()->count())
                                  ->with('customer_count',Customer::all()->count());
    }
}
