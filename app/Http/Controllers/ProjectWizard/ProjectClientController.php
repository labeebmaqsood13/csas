<?php

namespace App\Http\Controllers\ProjectWizard;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


use App\Client;
use App\Project;
use App\User;
use App\Role;
use App\Assignment;
use App\Phase;
use App\Task;
use App\Sop;
use Auth;


class ProjectClientController extends Controller
{
    public function project_wizard(){
        
        //Authorizing managers to view project_wizard
        $role_id = Role::select('id')->where('name','Manager')->first();
        $user = Auth::user();
        $count = $user->role()->wherePivot('role_id',$role_id)->count();

        // if($count == 1)
        // {
            $clients = Client::all();    
            $tasks = Task::all();
            $roles = Role::all();
            // $user_ids = Role::select('user_id')->where('name','Analyst')->get();
            // dd($user_ids);
            // $role->user()->where('role_id',$role->id)->count()
            $users = Role::with('user')->where('name','=','Analyst')->get();
            $users = $users->lists('user');
            $users = $users[0];
            // dd($users->toArray());
            return view('project_wizard',compact('clients', 'tasks', 'users', 'roles'));
        // }
        // elseif($count == 0){
            // return \Redirect::route('dashboard')->with('message','Not authorized to access project wizard page');
        // }
    }


	public function create_client(Request $request){

        $client = Client::create([
            'name'    => $request->name,
            'user_id' => Auth::user()->id,
            ]);
        $clients = Client::all();
        // return view('create_project',compact('clients'))-with('message', $client . ' - Client Created');
        return \Redirect::route('project_wizard')->withInput(['clients'])->with('message', $client->name . ' - client created');

    }

    public function create_project_and_allocate_tasks(Request $request){


    	// return sizeof($request->due_date_task);
        // foreach($request->task as $task){
        //     echo $task;
        // }
        // die();
        $this->validate($request, [
            'client_name' => 'required',
            'project_name' => 'required',
            'subnet_from' => 'required',
            'subnet_to' => 'required',
            'location' => 'required',
            'due_date_project' => 'required',
            'description_project' => 'required',
            'users' => 'required',
            
        ]);

    	$client_id           = $request->client_name;
    	$project_name        = $request->project_name;
		$subnet_from         = $request->subnet_from;
		$subnet_to           = $request->subnet_to;
		$location            = $request->location;
		$due_date_project    = $request->due_date_project;
		$description_project = $request->description_project;
        $users               = $request->users;


        // $reporthost_id = $id;
        // $reportitems = new Reportitem();
        // $result = $reportitems->read($reporthost_id);
        // return response()->json($result);

		// $client_name = $request->input('client_name');
		// $project_name = $request->input('project_name');
		// $subnet_from = $request->input('subnet_from');
		// $subnet_to = $request->input('subnet_to');
		// $location = $request->input('location');
		// $due_date = $request->input('due_date');
		// $description = $request->input('description');

		$project = Project::create([
			'name'        => $project_name,
			'subnet_from' => $subnet_from,
			'subnet_to'   => $subnet_to,
			'location'    => $location,
			'due_date'    => $due_date_project,
			'description' => $description_project,
			'status'      => 'in progress',
			'client_id'   => $client_id,
			]);



        $phases = Phase::where('is_default','1')->get();

        foreach($phases as $phase){
            $new_phase = Phase::create([
                'name' => $phase->name,
                'is_default' => '0',
            ]);
            // $new_phase->project()->attach($project->id); if pivot table existed b/w projects & phases
            Sop::create([
                'phase_id' => $new_phase->id,
                'project_id' => $project->id,
            ]);
            $tasks = Task::where('phase_id', $phase->id)->get();
            foreach($tasks as $task){
                Task::create([
                    'name' => $task->name,
                    'phase_id' => $new_phase->id,
                ]);
            }

        }



        $user = Auth::user();
        // $user->role()->attach($role->id, 'is_manager'=>1);
        $user->project()->attach([$project->id => ['is_manager' => 1]]);


        foreach($users as $user){
            $project->user()->attach([$user => ['is_manager' => 0]]);
        }
        


        return \Redirect::route('project_wizard')->with('message', 'Projct Created');

    }

}











