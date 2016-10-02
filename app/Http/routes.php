<?php

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
Route::get('file_upload', 'HomeController@file_upload')->name('file_upload');

Route::get('dashboard', 'HomeController@dashboard')->name('dashboard');

Route::get('reportitems/{reporthost_id}', 'HomeController@reportitems')->name('reportitems');


Route::get('invite_user',function(){
	return view('invite_user');
});
Route::post('invite_user','InviteUser\InviteUserController@invite_user');
Route::get('check_status/{code?}', 'InviteUser\InviteUserController@check_status');
Route::post('register_user', 'InviteUser\InviteUserController@register_user');



Route::get('/', function () {
    return view('index');
})->name('home');



// Nessus routes
Route::get('nessus/word','NessusController@word')->name('nessus.word');
Route::get('nessus/pdf','NessusController@pdf')->name('nessus.pdf');
Route::get('nessus/excel','NessusController@excel')->name('nessus.excel');
Route::get('nessus/webpage','NessusController@webpage')->name('nessus.webpage');
Route::post('nessus/upload', 'NessusController@upload')->name('nessus.upload');
Route::get('reports', 'NessusController@reports')->name('nessus.reports'); 
Route::get('nessus/updated_word','NessusController@updated_word')->name('nessus.updated_word');
Route::get('nessus/updated_pdf','NessusController@updated_pdf')->name('nessus.updated_pdf');

// Nmap routes
Route::get('nmap/word','NmapController@word')->name('nmap.word');
Route::get('nmap/pdf','NmapController@pdf')->name('nmap.pdf');
Route::get('nmap/excel','NmapController@excel')->name('nmap.excel');
Route::get('nmap/webpage','NmapController@webpage')->name('nmap.webpage');
Route::post('nmap/upload', 'NmapController@upload')->name('nmap.upload'); 


// Uncomment to make authentication work.
// Route::auth();
// Route::get('/', 'HomeController@index');
