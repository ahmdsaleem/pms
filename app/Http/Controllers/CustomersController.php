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
        $filter_projects=array();

        if(!empty($request->get('projects')) )
        {
            $projects = $request->get('projects');
            $all_projects=json_decode(Auth::user()->projects->pluck('id'));
            for ($i=0;$i<count($projects);$i++)
            {
                if(in_array($projects[$i],$all_projects))
                {
                 array_push($filter_projects,$projects[$i]);
                }
            }
        }
        else
        {
            $filter_projects=Auth::user()->projects->pluck('id');
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

        $customers = Customer::whereIn('project_id',$filter_projects)->whereBetween('created_at',[$startDate,$endDate])->skip($start)->take($length)->get();
        $total_customers= Customer::whereIn('project_id',$filter_projects)->whereBetween('created_at',[$startDate,$endDate])->count();
        $parameters=array();
        $parameters['draw']=$draw;
        $parameters['recordsTotal']=$total_customers;
        $parameters['recordsFiltered']=$total_customers;
        foreach ($customers as $customer)
        {
            $customer['project_assigned']=$customer->project->name;
            $customer['action']='<a onclick=""> <l title="Edit User Details" style="margin:10px" class="fa fa-pencil-square-o"></l> </a>'.
                '<a onclick=""> <l title="Delete User" style="margin:10px" class="font-icon font-icon-trash"></l></a>';

        }
        $parameters['data']=$customers;
        $parameters['input']=array();
        return $parameters;
    }

}
