<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    public function index()
    {
        return view('customers.index')->with('products',Product::all());
    }

    public function filter(Request $request)
    {

       $splitDate= explode('-', $request->daterange,2);
        $startDate=Carbon::parse($splitDate[0])->toDateTimeString();
        $endDate=Carbon::parse($splitDate[1])->toDateTimeString();



        $customers=Customer::whereIn('product_id',$request->products)->whereBetween('created_at',[$startDate,$endDate])->get();

        foreach ($customers as $customer)
        {
            $customer['product_assigned']=$customer->product->name;
            $customer['action']='<a onclick=""> <l title="Edit User Details" style="margin:10px" class="fa fa-pencil-square-o"></l> </a>'.
                '<a onclick=""> <l title="Delete User" style="margin:10px" class="font-icon font-icon-trash"></l></a>';

        }

        return response()->json($customers);

    }


    public function getCustomers(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $search['value']=true;


        if(!empty($request->get('products')))
        {
            $products=$request->get('products');
        }
        else
        {
            $products=Product::all()->pluck('id');
        }

        if(!empty($request->daterange)) {
            $splitDate = explode('-', $request->daterange, 2);
            $startDate = Carbon::parse($splitDate[0])->toDateTimeString();
            $endDate = Carbon::parse($splitDate[1])->toDateTimeString();
        }
        else
        {
            $startDate=Carbon::now()->subDays(30)->toDateTimeString();
            $endDate=Carbon::now()->toDateTimeString();
        }



        $customers = Customer::whereIn('product_id',$products)->whereBetween('created_at',[$startDate,$endDate])->get();
        $total_customers= count($customers);

        $parameters=array();
        $parameters['draw']=$draw;
        $parameters['recordsTotal']=$total_customers;
        $parameters['recordsFiltered']=$total_customers;

        foreach ($customers as $customer)
        {
            $customer['product_assigned']=$customer->product->name;
            $customer['action']='<a onclick=""> <l title="Edit User Details" style="margin:10px" class="fa fa-pencil-square-o"></l> </a>'.
                '<a onclick=""> <l title="Delete User" style="margin:10px" class="font-icon font-icon-trash"></l></a>';

        }

        $parameters['data']=$customers;
        $parameters['input']=array();
        return $parameters;
    }


}
