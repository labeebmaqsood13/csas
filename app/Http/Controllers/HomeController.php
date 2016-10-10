<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\Reporthost;
use App\Reportitem;

use App\User;
use App\Pluginid;

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


        $pluginid_count = Pluginid::count('id');
        return view('file_upload',compact('pluginid_count'));
    
    }





    public function permissions(){

        return view('permissions');

    }

 public function groups()
    {
        return view('groups');
    }



     public function users()
    {
        return view('users');
    }


     public function userDetails()
    {
        return view('userDetails');
    }



     public function editUsers()
    {
        return view('editUsers');
    }


     public function index_activity()
    {
        return view('index_activity');
    }
    
    public function create_project()
    {
        return view('create_project');
    }

     public function analytics_dashboard()
    {
        return view('analytics_dashboard');
    }

    public function dummy(){

        return view('userDetails');
    }

}
