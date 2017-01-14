<?php
use App\User;
use App\Role;
use App\Client;
use App\Permission;
use Auth as auth;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
// -------------- Faisal Routes start here ----------------- //
	
	Route::post('update/{id}',['as' => 'update', 'uses' => 'HomeController@update']);

	Route::get('permissions', 'HomeController@permissions')->name('permissions');
	Route::post('change_permissions', 'HomeController@change_permissions')->name('change_permissions');

	Route::get('index_activity', 'HomeController@index_activity')->name('index_activity');


// ------------------- ROLES ----------------------- //

	// Route::get('roles', 'HomeController@roles')->name('roles');
	// if(Auth::user()->role()->first()->permission()->where('name', 'Edit Role')->count()){
		Route::resource('roles','RoleController', ['except'=> ['create'] ]);
	// }
	Route::post('edit_role','RoleController@edit_role');
   Route::post('roledata','HomeController@role_data')->name('role_data');
   Route::post('roledatachange','HomeController@role_datachange')->name('role_datachange');

// ------------ File upload route ---------------------- //
	
	Route::get('file_upload', 'HomeController@file_upload')->name('file_upload');
	

// --------------Analytics Dashboard routes -----------------//



	Route::get('analytics_dashboard/{client_id?}/{project_id?}', 'HomeController@analytics_dashboard')->name('analytics_dashboard');


// --------------Analysis Dashboard routes -----------------//

	Route::get('dashboard/{client_id?}/{project_id?}', 'HomeController@dashboard')->name('dashboard');
	
	Route::post('dashboard3_get_projects','HomeController@dashboard3_get_projects')->name('dashboard3_get_projects');

	Route::get('reportitems/{reporthost_id}', 'HomeController@reportitems')->name('reportitems');


// ------------------- USERS ----------------------- //

	// Ajax Call from USER EDIT Button 
	Route::get('users/{id}', 'HomeController@userDetails')->name('userDetails');

	// Display Users
	Route::get('users', 'HomeController@users')->name('users');
    Route::post('users', 'HomeController@user_role_up')->name('users_role_up');
	// Invite User routes
	// Route::get('invite_user', function(){ return view('invite_user');}); // Separate view for email input 
	Route::post('invite_user','InviteUser\InviteUserController@invite_user');
	Route::get('check_status/{code}', 'InviteUser\InviteUserController@check_status');
	Route::post('register_user', 'InviteUser\InviteUserController@register_user');

	
	Route::get('editUsers', 'HomeController@editUsers')->name('editUsers');

	// Delete Users
	Route::delete('users/{user_id}','HomeController@user_delete')->name('users_delete');

    // Dummy users and roles creation 
	Route::get('create_user','NessusController@create_user');

	// Old View developed for generating reports
	// Route::get('/', function () {
	//     return view('index');
	// })->name');
    


// ------------- Project Wizard routes ------------------ //

	// Project wizard main page
	Route::get('project_wizard', 'ProjectWizard\ProjectClientController@project_wizard')->name('project_wizard');

	// Create client
	Route::post('create_client','ProjectWizard\ProjectClientController@create_client')->name('clients.create');

	// Create Project
	Route::post('create_project_and_allocate_tasks', 'ProjectWizard\ProjectClientController@create_project_and_allocate_tasks')->name('create_project_and_allocate_tasks');

	// Create Tasks


// ------------ Nessus routes ----------------- //
	
	// Route::get('nessus/word','NessusController@word')->name('nessus.word');
	// Route::get('nessus/pdf','NessusController@pdf')->name('nessus.pdf');
	// Route::get('nessus/excel','NessusController@excel')->name('nessus.excel');
	// Route::get('nessus/webpage','NessusController@webpage')->name('nessus.webpage');
	Route::post('nessus/upload', 'NessusController@upload')->name('nessus.upload');
	Route::get('reports', 'NessusController@reports')->name('nessus.reports'); 
	Route::post('generate_report', 'NessusController@generate_report')->name('nessus.generate_report');
	Route::get('nessus/updated_word','NessusController@updated_word')->name('nessus.updated_word');
	Route::get('nessus/updated_pdf','NessusController@updated_pdf')->name('nessus.updated_pdf');

// --------------- Nmap routes ----------------- //
	
	// Route::get('nmap/word','NmapController@word')->name('nmap.word');
	// Route::get('nmap/pdf','NmapController@pdf')->name('nmap.pdf');
	// Route::get('nmap/excel','NmapController@excel')->name('nmap.excel');
	// Route::get('nmap/webpage','NmapController@webpage')->name('nmap.webpage');
	// Route::post('nmap/upload', 'NmapController@upload')->name('nmap.upload'); 


// --------------- Authentication routes -------------- //
	
	Route::auth();
	Route::get('/', 'HomeController@index');

// ---------------- Xeditable experiment -------------- //

	Route::get('test', ['uses' => 'TestController@index']);
	Route::post('test/update/{id}','TestController@update')->name('test/update');
	Route::post('test/bulk_update', ['as' => 'test/bulk_update', 'uses' => 'TestController@bulk_update']);


// -------------- TESTING ------------ //
	Route::get('testing',function(){
		$users = User::all();
		$roles =  Role::paginate(5);
		return view('edit_Roles',compact('users','roles'));
	});















// ------------- Customize/sop ------------------ //
	Route::get('profile','HomeController@profile')->name('profile');
    Route::get('profile/{id}','HomeController@profile')->name('profile');
    Route::post('profile/uploadd','HomeController@uploadd')->name('uploadd');

    Route::get('sop','HomeController@sop')->name('sop');
    Route::post('sop/updatep/{id}','HomeController@updatep')->name('sop/updatep');
	Route::post('sop/update/{id}','HomeController@update')->name('sop/update');
	Route::delete('sop/{id}/{x}','HomeController@delete_task')->name('delete_task');
	Route::delete('sop/{id}/{projectid}','HomeController@delete_taskss')->name('delete_taskss');

	Route::delete('sop/{id}','HomeController@delete_phase')->name('delete_phase');
	Route::post('{id?}/create_task_sop','HomeController@create_task_sop');
	Route::post('create_task_sop_custom','HomeController@create_task_sop_custom');
    Route::post('{id?}/create_phase_sop','HomeController@create_phase_sop');
       Route::post('create_phase_sop_custom','HomeController@create_phase_sop_custom');

// ------------- projects_tasks ------------------ //

    // Route::get('projects_tasks', 'HomeController@projects_tasks')->name('projects_tasks');
    Route::get('projects_tasks/{id?}', 'HomeController@projects_tasks')->name('projects_tasks');
    
    Route::delete('projects_tasks/{name}/{pr}','HomeController@delete_member')->name('delete_member');
    Route::post('{id?}/user_add', 'HomeController@user_add');
    Route::post('{id?}/assign_member','HomeController@assign_member');
	//Route::delete('projects_tasks/{id}','HomeController@delete_task_sop')->name('delete_task_sop');
	Route::post('{id?}/delete_file','HomeController@delete_file')->name('delete_file');
    Route::post('{id?}/upload_update_file','NessusController@upload_update_file')->name('upload_update_file');


// ------------- mytask------------------ //

	 Route::get('mytasks','HomeController@mytasks')->name('mytasks');
     Route::post('delete_user','HomeController@delete_user')->name('delete_user');

// ------------- edit_clients_projects ------------------ //

    Route::get('edit_clients_projects/{id?}', 'HomeController@edit_clients_projects')->name('edit_clients_projects');
    Route::post('edit_clients_projects/updatee/{id}','HomeController@updatee')->name('edit_clients_projects/updatee');
	

// ------------- Project Wizard routes ------------------ //

	// Project wizard main page
	Route::get('project_wizard', 'ProjectWizard\ProjectClientController@project_wizard')->name('project_wizard');

	// Create client
	Route::post('create_client','ProjectWizard\ProjectClientController@create_client')->name('clients.create');

	// Create Project
	Route::post('create_project_and_allocate_tasks', 'ProjectWizard\ProjectClientController@create_project_and_allocate_tasks')->name('create_project_and_allocate_tasks');

	// Create Tasks
	Route::post('create_new_task','ProjectWizard\ProjectClientController@create_new_task');











