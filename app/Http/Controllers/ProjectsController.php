<?php

namespace App\Http\Controllers;

use App\Classes\Response;
use App\Platform;
use App\Project;
use App\ProjectIntegration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller
{
    const MODULE = 'project';

    public function index()
    {
        return view('projects.index')->with('platforms',Platform::all());
    }


    public function store(Request $request)
    {

        $response=new Response();

        try {

            $this->validate($request, [
                'name'=> 'required',
            ]);

            $project = Project::create([
                'name' => $request->get('name'),
                'description' => $request->get('description'),
                'platform_id' => $request->get('platform'),
                ]);

            Auth::user()->projects()->attach($project->id);






            $response->setResponse(true, 200, 'auth'.'.'.SELF::MODULE . '.' . '200');
        }
        catch(\Exception $e)
        {
            $response->setResponse(false, 400, 'auth'.'.'.SELF::MODULE . '.' . '400');
        }

        return response()->json($response->getResponse());
    }

    public function edit($id)
    {
        $response= new Response();
        try {
            $project = Project::findOrFail($id);
            return response()->json($project);
        }
        catch (\Exception $ex)
        {
            $response->setResponse(false, 400, 'auth'.'.'.SELF::MODULE . '.' . '400');
            return response()->json($response->getResponse());
        }
    }


    public function update(Request $request, $id)
    {
        $response=new Response();
        try {

            $this->validate($request, [
                'name'=> 'required'
            ]);

            $project = Project::findOrFail($id);
            $project->name = $request->get('name');
            $project->description = $request->get('description');
            $project->platform_id=$request->get('platform');
            $project->save();
            $response->setResponse(true, 200, 'auth'.'.'.SELF::MODULE . '.' . '200');
        }
        catch (\Exception $ex)
        {
            $response->setResponse(false, 400, 'auth'.'.'.SELF::MODULE . '.' . '400');
        }

        return response()->json($response->getResponse());
    }



    public function destroy($id)
    {
        $response=new Response();
        try {
            $project = Project::findOrFail($id);

            foreach ($project->users as $user)
            {
                $user->projects()->detach($project->id);
            }
            foreach ($project->customers as $customer)
            {
                $customer->delete();
            }

            Project::destroy($id);
            $response->setResponse(true, 200, 'auth'.'.'.SELF::MODULE . '.' . '200');
        }
        catch (\Exception $ex)
        {
            $response->setResponse(false, 400, 'auth'.'.'.SELF::MODULE . '.' . '400');
        }

        return response()->json($response->getResponse());

    }



    public function getProjects(Request $request)
    {

        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $search['value']=true;

        $projects = Project::skip($start)->take($length)->get();
        $total_projects = Project::all()->count();

        $parameters=array();
        $parameters['draw']=$draw;
        $parameters['recordsTotal']=$total_projects;
        $parameters['recordsFiltered']=$total_projects;

        foreach ($projects as $project)
        {
            if(!empty($project->platform->name)) {
                $project['platform_assigned'] = $project->platform->name;
            }
            else
            {
                $project['platform_assigned'] = "";
            }
            $project['action']='<a onclick="ProjectController.editProject('.$project->id.')"> <l title="Edit Project Details" style="margin:10px" class="fa fa-pencil-square-o"></l> </a>'.
                '<a onclick="ProjectController.deleteProject('.$project->id.')"> <l title="Delete Project" style="margin:10px" class="font-icon font-icon-trash"></l></a>';
        }

        $parameters['data']=$projects;
        $parameters['input']=array();
        return $parameters;

    }


}
