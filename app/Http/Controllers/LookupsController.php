<?php

namespace App\Http\Controllers;

use App\PlatformField;
use App\PlatformFieldValue;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Classes\Jvzoo;
class LookupsController extends Controller
{


    public function index()
    {
        return view('lookups.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {

        $project=Project::find($id);

        if($project->platform->name=="jvzoo") {

            $jvzoo=new Jvzoo();
            $jvzoo->SetCredentials($project);
            $status_code = $jvzoo->getStatusCode();
            if($status_code==204)
            {
                return view('lookups.show')->with('transactions',"")
                    ->with('project',$project);
            }
            else if($status_code==404)
            {
                request()->session()->flash('error','Cannot connect to Api Please Provide Correct Credentials');
                return view('lookups.show')->with('transactions',"")
                    ->with('project',$project);
            }
            else if($status_code==200)
            {
                $data=$jvzoo->getTransactions();
                return view('lookups.show')->with('transactions',$data->results)
                    ->with('project',$project);
            }

        }

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
        //
    }

    public function getProjects(Request $request)
    {

        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $search['value']=true;

        $projects = Auth::user()->projects()->skip($start)->take($length)->get();
        $total_projects = Auth::user()->projects()->count();

        $parameters=array();
        $parameters['draw']=$draw;
        $parameters['recordsTotal']=$total_projects;
        $parameters['recordsFiltered']=$total_projects;

        foreach ($projects as $project)
        {
            $project['platform_assigned'] = $project->platform->name;
            $project['action']='<a href="'.route('lookup.project',['id' => $project->id]).'"> <l title="Perform Lookup" style="margin:10px" class="glyphicon glyphicon-search"></l> </a>';
        }

        $parameters['data']=$projects;
        $parameters['input']=array();
        return $parameters;

    }


}
