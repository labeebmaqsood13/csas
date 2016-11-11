<?php

namespace App\Http\Controllers\ProjectWizard;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


use App\Client;
use App\Project;
use App\Task;
use App\User;
use App\Assignment;
use Auth;


class ProjectClientController extends Controller
{
    public function project_wizard(){

        $clients = Client::all();    
        $tasks = Task::all();
        $users = User::all();
        return view('project_wizard',compact('clients', 'tasks', 'users'));
    
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

    	$client_id           = $request->client_name;
    	$project_name        = $request->project_name;
		$subnet_from         = $request->subnet_from;
		$subnet_to           = $request->subnet_to;
		$location            = $request->location;
		$due_date_project    = $request->due_date_project;
		$description_project = $request->description_project;

    	// die();

    	// foreach($request->due_date_task as $key => $task){

    	// 	$due_date_task[$key] = $task;	
    	
    	// }
    	
    	// foreach($request->description_task as $key => $description){

    	// 	$description_task[$key] = $description;	
    	
    	// }
    	// // $due_date_project = $request->due_date_task[1];
    	// echo '<pre>';
    	// // print_r($due_date_task);
    	// var_dump($members);
    	// // print_r($description_task);
    	// echo '</pre>';
    	// die();

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

        $user = Auth::user();
        // $user->role()->attach($role->id, 'is_manager'=>1);
        $user->project()->attach([$project->id => ['is_manager' => 1]]);

        foreach($request->member as $key => $member){

            Assignment::create([
                'user_id'     => $member, 
                'due_date'    => $request->due_date_task[$key],
                'description' => $request->description_task[$key],                
                'task_id'     => $request->task[$key],
                'project_id'  => $project->id,
                ]);
            // echo $request->due_date_task[$key];   
            // echo $request->description_task[$key]; 
            // echo $project->id;
            // echo '<br>';
        
        }

        return \Redirect::route('project_wizard')->with('message', 'Projct Created');

    }

}











