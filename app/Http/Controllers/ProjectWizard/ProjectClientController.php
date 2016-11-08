<?php

namespace App\Http\Controllers\ProjectWizard;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


use App\Client;
use App\Project;
use App\Task;
use App\User;
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

    	$client_name  = $request->client_name;
    	$project_name = $request->project_name;
		$subnet_from  = $request->subnet_from;
		$subnet_to    = $request->subnet_to;
		$location     = $request->location;
		$due_date     = $request->due_date_project;
		$description  = $request->description_project;

		foreach($request->member as $key => $member){

			echo $member;
    		// $member[$key] = $member;	
    	
    	}
    	die();

    	foreach($request->due_date_task as $key => $task){

    		$due_date_task[$key] = $task;	
    	
    	}
    	
    	foreach($request->description_task as $key => $description){

    		$description_task[$key] = $description;	
    	
    	}
    	// $due_date_project = $request->due_date_task[1];
    	echo '<pre>';
    	// print_r($due_date_task);
    	var_dump($member);
    	// print_r($description_task);
    	echo '</pre>';
    	exit;

        // $reporthost_id = $id;
        // $reportitems = new Reportitem();
        // $result = $reportitems->read($reporthost_id);
        // return response()->json($result);

		$client_name = $request->input('client_name');
		$project_name = $request->input('project_name');
		$subnet_from = $request->input('subnet_from');
		$subnet_to = $request->input('subnet_to');
		$location = $request->input('location');
		$due_date = $request->input('due_date');
		$description = $request->input('description');

		$project = Project::create([
			'name' => $project_name,
			'subnet_from' => $subnet_from,
			'subnet_to' => $subnet_to,
			'location' => $location,
			'due_date' => $due_date,
			'description' => $description,
			'status' => 'in progress',
			'client_id' => $client_name,
			'user_type' => 'manager',
			]);
		$user = Auth::user();

		$user->attach()->project($project);

		$data = 'success';
		return response()->json($data);

    }

}











