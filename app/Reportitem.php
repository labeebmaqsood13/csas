<?php

namespace App;

use DB;

use Illuminate\Database\Eloquent\Model;

class Reportitem extends Model
{
	protected $table = 'reportitems';
	protected $hidden = [];

	protected $fillable = ['port','svc_name','protocol','severity','plugin_id','plugin_name','plugin_family','description','fname','plugin_type','risk_factor','solution','synopsis','plugin_output','reporthost_id'];
	

	public function store($reportitem){

		Reportitem::create([
    			'reporthost_id'	=>  $reportitem['lastinsertedid'],
    			'port' 		 	=>  $reportitem['port'],
    			'svc_name' 		=>  $reportitem['svc_name'],
    			'protocol' 		=>  $reportitem['protocol'],
    			'severity' 		=>  $reportitem['severity'],
    			'plugin_id' 	=>  $reportitem['plugin_id'],
    			'plugin_name' 	=>  $reportitem['plugin_name'],
    			'plugin_family' =>  $reportitem['plugin_family'],
    			'description' 	=>  $reportitem['description'],
    			'risk_factor' 	=>  $reportitem['risk_factor'],
    			'solution' 		=>  $reportitem['solution'],
    			'plugin_output' =>  $reportitem['plugin_output'],
    			'synopsis'		=>  $reportitem['synopsis'],

    					]);


	}

    public function read($reporthost_id){

        return Reportitem::where('reporthost_id', $reporthost_id)->get();
        // return Reportitem::find($reporthost_id);

    }


    public function get_vulnerabilities($project_id){

        // -- Manually fetching all and making assoc array which gets each plugin_name's count
        // $new_array = [];
        // $array = Reportitem::all();
        // foreach($array as $each){
        //     $new_array[$each->plugin_name] = Reportitem::where('plugin_name',$each->plugin_name)->count();
        // }

        $reportfiles = Reportfile::where('project_id', $project_id)->get();
        $reportfile_ids = $reportfiles->lists('id');
        $reporthosts = Reporthost::whereIn('reportfile_id', $reportfile_ids)->get();
        $reporthost_ids = $reporthosts->lists('id');

        $new_array = DB::table('reportitems')
                 ->select('plugin_name', DB::raw('count(*) as total'))
                 ->groupBy('plugin_name')
                 ->orderBy('total','DESC')
                 ->limit('10')
                 ->whereIn('reporthost_id', $reporthost_ids)
                 ->get();         
        return $new_array;

    }

    public function read_reportitems_having_unique_reporthost_id($project_id){

        $reportfiles = Reportfile::where('project_id', $project_id)->get();
        $reportfile_ids = $reportfiles->lists('id');
        $reporthosts = Reporthost::whereIn('reportfile_id', $reportfile_ids)->get();
        $reporthost_ids = $reporthosts->lists('id');

        // Get distinct plugin_name against distinct reporthost_id using groupBy()
        $reportitem = DB::table('reportitems')
            ->whereIn('reporthost_id', $reporthost_ids)
            ->groupBy('reporthost_id', 'plugin_name')
            ->orderBy('reportitems.id', 'asc')
            ->get();


        // // Trying to get each vulnerability and its distinct reporthost_id  
        // $reportitem = DB::table('reportitems')
        //     // ->join('reporthosts', 'reportitems.reporthost_id', '=', 'reporthosts.id')
        //     ->select('reportitems.*', DB::raw('count(*) as total'))
        //     ->groupBy('reportitems.plugin_name')
        //     ->get();
            
        // Returns distinct/unique Vulnerabilities (plugin_name)
        // $reportitem = Reportitem::get()->unique('plugin_name');

        // Returns count of total ip's and mac of each Vulnerability(plugin_name) 
        // $reportitem = DB::table('reportitems')
        //     ->join('reporthosts', 'reportitems.reporthost_id', '=', 'reporthosts.id')
        //     ->select('reportitems.*', DB::raw('count(*) as total'))
        //     ->groupBy('reportitems.plugin_name')
        //     ->get();

        return $reportitem;

    }

    public function get_port_by_plugin_name_and_reporthost_id($plugin_name, $reporthost_id){

        return Reportitem::where('plugin_name', $plugin_name)->where('reporthost_id', $reporthost_id)->get();

    }


    public function reporthost(){
    	
    	return $this->belongsTo('App\Reporthost');

    }
}
