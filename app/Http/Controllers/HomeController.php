<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\Reporthost;
use App\Reportitem;

use App\User;
use App\Role;
use App\Pluginid;
use App\Client;

use Auth;

use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
    }


    public function dashboard()
    {
        $reporthost = new Reporthost();
        $reporthosts = $reporthost->read();
        // $reporthosts = json_decode(json_encode($reporthosts));
        // $reporthosts = (object) $reporthosts;
        // echo '<pre>';
        // print_r($reporthosts);
        // echo '</pre>';
        // die();
        // return $reporthosts;

        // $reporthosts = $reporthosts->paginate(5);
        $count = sizeof($reporthosts);
        // $reporthosts = new \Illuminate\Pagination\LengthAwarePaginator($reporthosts,$count,1);
        return view('dashboard',compact('reporthosts'));
    }

    public function reportitems($id){
          
        // $created_task = Task::create([
        //     'name'=> $request->input('name')
        //     ]);
        // $users  = User::all();
        // $create_task = {name:'faisal', phase:'enagement',users:''}
        // return $created_task;





        $reporthost_id = $id;
        $reportitems = new Reportitem();
        $result = $reportitems->read($reporthost_id);
        return response()->json($result);

    }    


    public function file_upload(){


        $pluginid_count = Pluginid::count('id');
        return view('file_upload',compact('pluginid_count'));
    
    }



    public function update(Request $request, $id)
    {
        $test = Dummy::find($id);
         Dummy::create([
            'name' => 'faisal',
            ]);
        $column_name = Input::get('name');
       
        
        if( Input::has('name')) {
            $test = Dummy::select()
                ->where('id', '=', $id)
                ->update([$column_name]);
            return response()->json([ 'code'=>200], 200);
        }
        
        return response()->json([ 'error'=> 400, 'message'=> 'Not enought params' ], 400);
    }  




    public function permissions(){

        return view('permissions');

    }

 public function roles()
    {
        // return response()->view('errors.503');
        // abort(403, 'Unauthorized action.');
        // $roles = Role::all();
        $roles = Role::paginate(5);
        $users = User::all();
        return view('roles', compact('users','roles'));
    }



    public function users()
    {
        $users = User::orderBy('id','DESC')->paginate(5);
        $roles = Role::all();
        return view('users', compact('users','roles'));
    }

    public function user_delete($id)
    {
        $user = User::find($id);
        $user->role()->detach();

        $user->delete();
        return \Redirect::route('users')->with('message', 'Success! User Deleted');   
    }

    public function dummy(){
        // $user = $user_data;
        return view('userDetails');
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
    
     public function analytics_dashboard()
    {
        return view('analytics_dashboard');
    }

    

}
