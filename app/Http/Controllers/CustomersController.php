<?php

namespace App\Http\Controllers;

use App\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomersController extends Controller
{
    public function index()
    {
        return view('customers.index');
    }


    public function getCustomers(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $search['value']=true;
        $filter_products=array();

        if(!empty($request->get('products')) )
        {
            $products = $request->get('products');
            $all_products=json_decode(Auth::user()->products->pluck('id'));
            for ($i=0;$i<count($products);$i++)
            {
                if(in_array($products[$i],$all_products))
                {
                 array_push($filter_products,$products[$i]);
                }
            }
        }
        else
        {
            $filter_products=Auth::user()->products->pluck('id');
        }

        if(!empty($request->daterange)) {
            $splitDate = explode('-', $request->daterange, 2);
            $startDate = Carbon::parse($splitDate[0])->toDateTimeString();
            $endDate = Carbon::parse($splitDate[1])->toDateTimeString();
        }
        else
        {
            $startDate=Carbon::now()->subDays(7)->toDateTimeString();
            $endDate=Carbon::now()->toDateTimeString();
        }

        $customers = Customer::whereIn('product_id',$filter_products)->whereBetween('created_at',[$startDate,$endDate])->skip($start)->take($length)->get();
        $total_customers= Customer::whereIn('product_id',$filter_products)->whereBetween('created_at',[$startDate,$endDate])->count();
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
