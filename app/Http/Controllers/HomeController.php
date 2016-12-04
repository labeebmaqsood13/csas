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
use App\Project;
use App\Test;
use App\Reportfile;

use Session;
use Auth;

use DB;

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

    // default client_id and project_id null if not passed in parameter of route 
    public function dashboard($client_id=null, $project_id=null)
    {
        $user = Auth::user();

        // When redirected by js window.location.href ..it will enter this if and wont have any session so this first part will get true and redirect now to same page with parameters and session.    
        
        if(!Session::has('fuck') && isset($client_id) && isset($project_id)){
            return \Redirect::action('HomeController@dashboard',['client_id' => $client_id, 'project_id' =>$project_id])->with('fuck', 'Fuck you');   
        }
        elseif(Session::has('fuck') && isset($client_id) && isset($project_id)){
            
            // IF user is assigned that project in project_user tbl or user is a manager 
            if( $user->project()->where('projects.id', $project_id)->where('projects.client_id',$client_id)->exists() || $user->role()->where('name', 'Manager')->count()){

                $projects = $user->project()->where('project_id', $project_id)->where('client_id',$client_id)->first();

                if($projects->reportfile()->exists()){

                    // Dummy client sent.
                    $clients = Client::where('name', 'Pepsi')->get();
                    
                    $reportfiles = Reportfile::where('project_id', $project_id)->get();
                    foreach($reportfiles as $reportfile){
                        
                        $reportfiles1[] = $reportfile->id;

                    }
                    $reporthosts = Reporthost::read($reportfiles1);


                    // $reporthosts ko tmp tbl mein rkhwa k read kro n wahan dashboard peh us variable say paginate kro 
                    $client_name = Client::find($client_id)->first();
                    $client_name = $client_name->name;
                    $project_name = Project::find($project_id)->first();
                    $project_name = $project_name->name;
                    return view('dashboard_copy',compact('clients','reporthosts','client_name','project_name'));

                }else{
                    return \Redirect::action('HomeController@dashboard')->with('message', 'The project you selected does not have any nessus source file uploaded.');
                }


            }else{
                return \Redirect::action('HomeController@dashboard')->with('message', 'The project is not assigned to you'); 
            }

        }
        // $reporthost = new Reporthost();
        // $reporthosts = $reporthost->read();
        // $reporthosts = json_decode(json_encode($reporthosts));
        // $reporthosts = (object) $reporthosts;
        // echo '<pre>';
        // print_r($reporthosts);
        // echo '</pre>';
        // die();
        // return $reporthosts;

        // $reporthosts = $reporthosts->paginate(5);
        
        // $count = sizeof($reporthosts);
        // $reporthosts = new \Illuminate\Pagination\LengthAwarePaginator($reporthosts,$count,1);

        // If client id inserted thru url and not project_id 
        if(isset($client_id) && !isset($project_id)){
            return \Redirect::action('HomeController@dashboard')->with('message', 'The project_id wasnt specified'); 
        }elseif(!isset($client_id) && !isset($project_id)){
            $user = Auth::user();

            // If manager
                $user_roles = $user->role()->where('name', 'manager')->get();
                foreach($user_roles as $user_role){
                    if($user_role->name == 'Manager'){
                        $clients = Client::all();
                        //Dummy value of reporthosts
                        $reporthosts = Reporthost::read(1);
                        return view('dashboard_copy',compact('clients','reporthosts'));
                    }
                }


            // ----If not manager---------------

                // First option //

                    $projects = $user->project()->groupBy('client_id')->get();
                    foreach($projects as $project){
                        // echo $project->client_id;
                        $clients[] = Client::find($project->client_id);
                    }
                    $reporthosts = Reporthost::read(1);
                    return view('dashboard_copy',compact('clients','reporthosts'));
                

                // Second Bad Approach of making arrays so not using it for now using the first option with groupby //
                    // $projects = $user->project()->get();

                    // foreach($projects as $project){
                    //     $clients_all[] = $project->client_id;    
                    // }

                    // // If i return n check $clients_all value in that array duplication exists but not when i do this next step
                    // $clients = Client::find($clients_all);

                    // // dd($clients);die();
                    // return view('dashboard_copy',compact('clients'));
        }            
    }

    public function dashboard3_get_projects(Request $request){

       $user = Auth::user();
       $project_array = $projects_list = array();
        
        // If manager 
        $user_roles = $user->role()->where('name', 'manager')->get();
        foreach($user_roles as $user_role){ 
            if($user_role->name == 'Manager'){
                // echo 'Allowed to view all projects in a client';
                // return response()->json($projects);
                return $projects =  Project::where('client_id', $request->input('client_id'))->get();
            }
        }  


        // -------------------- One way ----------------------//

            // If not manager
            $projects = Project::where('client_id', $request->input('client_id'))->get();
            foreach($projects as $project){
                // echo $project->user()->get();
                if(!is_null($project->user()->where('project_user.user_id', $user->id)->first())){
                    $project_array[] = $project->user()->where('project_user.user_id', $user->id)->first();
                }    
            }
            // Returns user model with the pivot table values.
            // return $project_array;

            foreach($project_array as $project){
                $projects_list[] = Project::find($project->pivot->project_id);
            }

            return $projects_list;

        // -------------------- Second way ----------------------// 
        
            // // If not manager
            // $projects = Project::where('client_id', '1')->get();
            // foreach($projects as $project){
            //     // echo $project->user()->get();
            //     if(!is_null($project->user()->where('project_user.user_id', $user->id)->first())){
            //         $project_array[] = Project::find($project->user()->where('project_user.user_id', $user->id)->first()->pivot->project_id);
            //     }    
            // }
            // // Returns user model with the pivot table values.
            // // dd($project_array);
            // return $project_array;           

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

        $user = Auth::user();
        $pluginid_count = Pluginid::count('id');
        $projects = $user->project()->get();
        return view('file_upload',compact('projects','pluginid_count'));
    

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



        // ------------------- Vulnerabilities Summary -------------------- //

            $user = Auth::user();
            // Fetching reportfiles by project_id
            $reportfiles = Reportfile::where('project_id',1)->where('user_id', $user->id)->get();

            // Fetching all reporthost_id in all those reportfiles fetched above
            foreach($reportfiles as $reportfile){
                $reporthosts = $reportfile->reporthost()->get();
                foreach($reporthosts as $reporthost){   
                    $reporthost_id[] = $reporthost->id;
                }  
            }
            // dd($reporthost_id);

            $reportitems_critical = Reportitem::whereIn('reporthost_id', array_flatten([$reporthost_id]))->where('risk_factor','critical')->count();
            $reportitems_high = Reportitem::whereIn('reporthost_id', array_flatten([$reporthost_id]))->where('risk_factor','high')->count();
            $reportitems_med = Reportitem::whereIn('reporthost_id', array_flatten([$reporthost_id]))->where('risk_factor','medium')->count();
            $reportitems_low = Reportitem::whereIn('reporthost_id', array_flatten([$reporthost_id]))->where('risk_factor','low')->count();


        // ------------ Top 10 (Potential) Vulnerabilities & their count in descending order ------------ //


            $top_ten_vulnerabilities = Reportitem::whereIn('reporthost_id', array_flatten([$reporthost_id]))->select( DB::raw('plugin_name ,COUNT(*) as count') )->groupBy('plugin_name')->orderBy('count','DESC')->take(10)->get();
            // dd($top_ten_vulnerabilities->toArray());

            $top_ten_vuln_names = $top_ten_vulnerabilities->lists('plugin_name');
            $top_ten_vuln_count = $top_ten_vulnerabilities->lists('count');

            // Alternative way of lists() used above
                // foreach($top_ten_vulnerabilities as $vuln){
                //     // echo $vuln->plugin_name;
                //     // echo $vuln->count;
                //     $top_ten_vuln_names[] =  $vuln->plugin_name;
                //     $top_ten_vuln_count[] =  $vuln->count;
                    
                // }

            // Example of count of repetition
                // $groups = Group::where(['owner_id' => Auth::user()->id, 'year' => 2016])
                //     ->groupBy('status')
                //     ->select( DB::raw('status , COUNT(*) as status_count') )
                //     ->get();


            // Example of lists..not proper
                // $vulnerabilities_count = Reportitem::whereIn('reporthost_id', array_flatten([$reporthost_id]))->groupBy('plugin_name')->get();
                // dd($vulnerabilities->lists('plugin_name'));





        // ------------------- Top 10 Compromised Machines  -------------------- //

            $reportfile_ids = $reportfiles->lists('id');
            // dd($reporthost_ids);
            
            $reporthosts = Reporthost::whereIn('reportfile_id',array_flatten([$reportfile_ids]))->get();
            // dd($reporthosts->toArray());
            
                // Echo ki jagah array mein store kr k phir us ko sort kr sakta...
                    // foreach($reporthosts as $reporthost){
                    //     echo $reporthost->host_ip. "   ";
                    //     echo $reporthost->reportitem()->count();
                    //     echo '<br>';

                    // }
                    // die();


            // ------------------ One method First eloquent Second raw sql ------------------------ //

                // Eloquent Reportitems walay table say track kia ...reporthost_id and uskay against count agaya ... end peh join add kia in Eloquent to woh bhi chal gya..so i can slect any column from both tables

                $abc = Reportitem::whereIn('reporthost_id',array_flatten([$reporthosts->lists('id')->toArray()]))
                    ->groupBy('reporthost_id')
                    ->select( DB::raw('reporthosts.host_ip, reportitems.reporthost_id ,COUNT(*) as count') )
                    ->orderBy('count', 'DESC')
                    ->join('reporthosts', 'reportitems.reporthost_id', '=', 'reporthosts.id')
                    ->limit(5)
                    ->get();
                // dd($abc->toArray());




                // Query builder Reportitems walay table say track kia ...reporthosts tbl say host_ip and uskay against count agaya ...
                $top_compromised_machines = collect(DB::table('reportitems')
                ->join('reporthosts', 'reportitems.reporthost_id', '=', 'reporthosts.id')
                ->select('reporthosts.host_ip', DB::raw('count(*) as count'))
                ->whereIn('reportitems.reporthost_id',array_flatten([$reporthosts->lists('id')->toArray()]))
                ->groupBy('reporthosts.host_ip')
                ->orderBy('count', 'DESC')
                ->limit(10)
                ->get());
                // dd($top_compromised_machines);

                $top_compromised_ip = $top_compromised_machines->pluck('host_ip');
                $top_compromised_ip_count = $top_compromised_machines->pluck('count');

                


        // ------------------- Count of Critical severity in each Ip  -------------------- //
                
                // No of critical severities found in which Ip's and how many
                //Critical severity count in Each ip
                $critical_severity_in_ip = Reportitem::whereIn('reporthost_id',array_flatten([$reporthosts->lists('id')->toArray()]))
                    ->where('reportitems.severity',4)
                    ->groupBy('reporthost_id')
                    ->select( DB::raw('reporthosts.host_ip ,COUNT(*) as count') )
                    ->join('reporthosts', 'reportitems.reporthost_id', '=', 'reporthosts.id')
                    // ->limit(5)
                    ->get();    
                // dd($critical_severity_in_ip->toArray());   

                $critical_ips = $critical_severity_in_ip->lists('host_ip');
                $critical_ips_count = $critical_severity_in_ip->lists('count');    



                //------ Differentiation for colors ... this returns total number of critical ----- //

                    $array_colors = ['#3498DB','lightgrey', '#7FC9D9'];
                    $colors = collect(array_slice($array_colors, 0,sizeof($critical_severity_in_ip->toArray())));

                        // $count_for_color =  sizeof($critical_severity_in_ip->toArray());

                        // for($i=0; $i<$count_for_color; $i++){

                        //     $colors[] = '#'.substr(md5(rand()), 0, 6);
                              
                        // }    
                        // $colors = collect($colors);
                        // dd($colors);  




        return view('analytics_dashboard',compact('reportitems_critical', 'reportitems_high', 'reportitems_med', 'reportitems_low', 'top_ten_vuln_count', 'top_ten_vuln_names', 'top_compromised_ip', 'top_compromised_ip_count', 'critical_ips', 'critical_ips_count', 'colors'));
    
    }

    public function projects_tasks()
    {
         $test = Test::select()
            ->orderBy('id')
            ->get()
            ;
        
        // $test_columns = Schema::getColumnListing('tests');
        $test_model = new Test();
        $fillable_columns = $test_model->getFillable();
        foreach ($fillable_columns as $key => $value) {
            $test_columns[$value] = $value;
        }
        
        return view('projects_tasks')
            ->with('test', $test)
            ->with('test_columns', $test_columns)
        ;
    }

}
