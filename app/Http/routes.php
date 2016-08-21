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

Route::get('/', function () {
    return view('index');
})->name('home');


// Nessus routes
Route::get('nessus/word','NessusController@word')->name('nessus.word');
Route::get('nessus/pdf','NessusController@pdf')->name('nessus.pdf');
Route::get('nessus/excel','NessusController@excel')->name('nessus.excel');
Route::get('nessus/webpage','NessusController@webpage')->name('nessus.webpage');
Route::post('nessus/upload', 'NessusController@upload')->name('nessus.upload'); 

// Nmap routes
Route::get('nmap/word','NmapController@word')->name('nmap.word');
Route::get('nmap/pdf','NmapController@pdf')->name('nmap.pdf');
Route::get('nmap/excel','NmapController@excel')->name('nmap.excel');
Route::get('nmap/webpage','NmapController@webpage')->name('nmap.webpage');
Route::post('nmap/upload', 'NmapController@upload')->name('nmap.upload'); 
