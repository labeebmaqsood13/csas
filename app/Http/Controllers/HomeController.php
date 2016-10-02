<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\Reporthost;
use App\Reportitem;

class HomeController extends Controller
{
    // Uncomment to make authentication work.
    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    // /**
    //  * Show the application dashboard.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    public function index()
    {
        return view('welcome');
    }

    public function dashboard()
    {
        $reporthost = new Reporthost();
        $reporthosts = $reporthost->read();

        return view('dashboard',compact('reporthosts'));
    }

    public function reportitems($id){
          
        $reporthost_id = $id;
        $reportitems = new Reportitem();
        $result = $reportitems->read($reporthost_id);
        return response()->json($result);

    }    






    public function file_upload(){

        return view('file_upload');
    
    }



}
