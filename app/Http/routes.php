<?php
use App\User;
use App\Role;
use App\Client;
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

	Route::get('index_activity', 'HomeController@index_activity')->name('index_activity');

	Route::get('analytics_dashboard', 'HomeController@analytics_dashboard')->name('analytics_dashboard');

// ------------------- ROLES ----------------------- //

	// Route::get('roles', 'HomeController@roles')->name('roles');
	Route::resource('roles','RoleController', ['except'=> ['create'] ]);
	Route::post('edit_role','RoleController@edit_role');


// ------------ File upload route ---------------------- //
	
	Route::get('file_upload', 'HomeController@file_upload')->name('file_upload');

// --------------Analysis Dashboard routes -----------------//

	Route::get('dashboard/{client_id?}/{project_id?}', 'HomeController@dashboard')->name('dashboard');
	
	Route::post('dashboard3_get_projects','HomeController@dashboard3_get_projects')->name('dashboard3_get_projects');

	Route::get('reportitems/{reporthost_id}', 'HomeController@reportitems')->name('reportitems');

// ------------------- USERS ----------------------- //

	// Ajax Call from USER EDIT Button 
	Route::get('dummy/', 'HomeController@dummy')->name('dummy');

	// Display Users
	Route::get('users', 'HomeController@users')->name('users');

	// Invite User routes
	// Route::get('invite_user', function(){ return view('invite_user');}); // Separate view for email input 
	Route::post('invite_user','InviteUser\InviteUserController@invite_user');
	Route::get('check_status/{code}', 'InviteUser\InviteUserController@check_status');
	Route::post('register_user', 'InviteUser\InviteUserController@register_user');

	// Edit Users
	//Route::get('userDetails', 'HomeController@userDetails')->name('userDetails');
	Route::get('editUsers', 'HomeController@editUsers')->name('editUsers');

	// Delete Users
	Route::delete('users/{user_id}','HomeController@user_delete')->name('users_delete');

    // Dummy users and roles creation 
	Route::get('create_user','NessusController@create_user');

	// Old View developed for generating reports
	// Route::get('/', function () {
	//     return view('index');
	// })->name('home');


// ------------- Project Wizard routes ------------------ //

	// Project wizard main page
	Route::get('project_wizard', 'ProjectWizard\ProjectClientController@project_wizard')->name('project_wizard');

	// Create client
	Route::post('create_client','ProjectWizard\ProjectClientController@create_client')->name('clients.create');

	// Create Project
	Route::post('create_project_and_allocate_tasks', 'ProjectWizard\ProjectClientController@create_project_and_allocate_tasks')->name('create_project_and_allocate_tasks');

	// Create Tasks


// ------------ Nessus routes ----------------- //
	
	Route::get('nessus/word','NessusController@word')->name('nessus.word');
	Route::get('nessus/pdf','NessusController@pdf')->name('nessus.pdf');
	Route::get('nessus/excel','NessusController@excel')->name('nessus.excel');
	Route::get('nessus/webpage','NessusController@webpage')->name('nessus.webpage');
	Route::post('nessus/upload', 'NessusController@upload')->name('nessus.upload');
	Route::get('reports', 'NessusController@reports')->name('nessus.reports'); 
	Route::get('nessus/updated_word','NessusController@updated_word')->name('nessus.updated_word');
	Route::get('nessus/updated_pdf','NessusController@updated_pdf')->name('nessus.updated_pdf');

// --------------- Nmap routes ----------------- //
	
	Route::get('nmap/word','NmapController@word')->name('nmap.word');
	Route::get('nmap/pdf','NmapController@pdf')->name('nmap.pdf');
	Route::get('nmap/excel','NmapController@excel')->name('nmap.excel');
	Route::get('nmap/webpage','NmapController@webpage')->name('nmap.webpage');
	Route::post('nmap/upload', 'NmapController@upload')->name('nmap.upload'); 


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



// -------------- Project wizard test page jo faisal nay bnaya us say routes and main2 ki file update kro and action and view dekho -----------//
Route::get('projects_tasks', 'HomeController@projects_tasks')->name('projects_tasks');









