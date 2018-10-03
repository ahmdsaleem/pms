<?php

namespace App\Http\Controllers;

use App\Customer;
use App\IpnTransaction;
use App\PlatformFieldValue;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomersController extends Controller
{
    public function index()
    {
        return view('customers.index');
    }


    function jvzipnVerification() {
        $secretKey = "FKUqVrWo92yQne6VCmjB";
        $pop = "";
        $ipnFields = array();
        foreach ($_POST AS $key => $value) {
            if ($key == "cverify") {
                continue;
            }
            $ipnFields[] = $key;
        }
        sort($ipnFields);
        foreach ($ipnFields as $field) {
            // if Magic Quotes are enabled $_POST[$field] will need to be
            // un-escaped before being appended to $pop
            $pop = $pop . $_POST[$field] . "|";
        }
        $pop = $pop . $secretKey;
        if ('UTF-8' != mb_detect_encoding($pop))
        {
            $pop = mb_convert_encoding($pop, "UTF-8");
        }
        $calcedVerify = sha1($pop);
        $calcedVerify = strtoupper(substr($calcedVerify,0,8));
        return $calcedVerify == $_POST["cverify"];
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'ccustname' =>'required',
            'ccustemail'=>'required'
        ]);

        $project_id=PlatformFieldValue::where('field_value','=',$request->get('cproditem'))->first()->project_id;

        $customer=Customer::where('email','=',$request->get('ccustemail'))->where('project_id','=',$project_id)->first();

        if($customer==null)
        {
            $customer=Customer::create([
                'name' => $request->get('ccustname'),
                'email' => $request->get('ccustemail'),
                'state' => $request->get('ccuststate'),
                'country_code' => $request->get('ccustcc'),
                'project_id' => $project_id
            ]);
        }

        IpnTransaction::create([
            'customer_id' => $customer->id,
            'project_id'=> $project_id,
            'type' => $request->get('ctransaction'),
            'amount_transfered' => $request->get('ctransamount'),
            'payment_method' => $request->get('ctranspaymentmethod'),
            'transaction_id' =>$request->get('ctransreceipt'),
            'time' => $request->get('ctranstime'),
            ]);




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

        }
        $parameters['data']=$customers;
        $parameters['input']=array();
        return $parameters;
    }

}
