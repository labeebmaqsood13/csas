<?php

namespace App;

use DB;

use Illuminate\Database\Eloquent\Model;

class Reporthost extends Model
{
    protected $table = 'reporthosts';
    protected $hidden = [];

    protected $fillable = ['cpe_1','ssh_fingerprint','host_end','last_unauthenticated_results','credentialed_scan','policy_name','total_cves','cpe','os','cpe_0','system_type','operating_system','mac','traceroute_hop_4','traceroute_hop_3','traceroute_hop_2','traceroute_hop_1','traceroute_hop_0','host_fqdn','host_ip','netbios_name','host_start', 'reportfile_id'];
    

    public function store($reporthost_metadata, $reportfile_id){

    	$reporthost = Reporthost::create([
		    			'cpe_1' 		 				=>  $reporthost_metadata['cpe_1'],
		    			'ssh_fingerprint' 		 		=>  $reporthost_metadata['ssh_fingerprint'],
		    			'host_end' 						=>  $reporthost_metadata['host_end'], 
		    			'last_unauthenticated_results'  =>  $reporthost_metadata['last_unauthenticated_results'], 
		    			'credentialed_scan'			    =>  $reporthost_metadata['credentialed_scan'], 
		    			'policy_name'					=>  $reporthost_metadata['policy_name'],
		    			'total_cves'					=>  $reporthost_metadata['total_cves'],
		    			'cpe'							=>  $reporthost_metadata['cpe'],
		    			'os'							=>  $reporthost_metadata['os'],
		    			'cpe_0'							=>  $reporthost_metadata['cpe_0'],
		    			'system_type'					=>  $reporthost_metadata['system_type'],
		    			'operating_system'				=>  $reporthost_metadata['operating_system'],
		    			'mac'							=>  $reporthost_metadata['mac'],
		    			'traceroute_hop_4'				=>  $reporthost_metadata['traceroute_hop_4'],
		    			'traceroute_hop_3'				=>  $reporthost_metadata['traceroute_hop_3'],
		    			'traceroute_hop_2'				=>  $reporthost_metadata['traceroute_hop_2'],
		    			'traceroute_hop_1'				=>  $reporthost_metadata['traceroute_hop_1'],
		    			'traceroute_hop_0'				=>  $reporthost_metadata['traceroute_hop_0'],
		    			'host_fqdn'						=>  $reporthost_metadata['host_fqdn'],
		    			'host_ip'						=>  $reporthost_metadata['host_ip'],
		    			'netbios_name'					=>  $reporthost_metadata['netbios_name'],
		    			'host_start'					=>  $reporthost_metadata['host_start'],
		    			'reportfile_id'					=> 	$reportfile_id,


		    					]);

    	return $lastinsertedid = $reporthost->id;

    }


	public static function read($reporthost_id){

        // $reporthost->reporitem()->get();

        $reporthosts = DB::table('reporthosts')
            ->join('reportitems', 'reporthosts.id', '=', 'reportitems.reporthost_id')
            ->select('reporthosts.*', 'reporthosts.id', 
            		DB::raw('count(reportitems.plugin_name) as total')
            		// Trying to make it work like a subquery to get count of plugin_names with '2' severity
            		// DB::raw('count(reportitems.plugin_name) as high FROM reportitems WHERE reportitems.reporthost_id = reporthosts.id WHERE severity = 2 ')
            		)
            // ->where('reportitems.severity','4')
            ->whereIn('reporthosts.reportfile_id', array_flatten([$reporthost_id]))
            ->orderBy('total','DESC')       
            ->groupBy('reporthosts.host_ip')
            ->get();

        // Converting Std Object into Simple Array    
        $reporthosts = json_decode(json_encode($reporthosts), True);    

        foreach($reporthosts as $key => $each){

        	$high = $reportitems = DB::table('reportitems')
	            ->where('reporthost_id',$each['id'])
    	        ->where('severity', '4')
        	    ->count(); 


        	$med = $reportitems = DB::table('reportitems')
	            ->where('reporthost_id',$each['id'])
    	        ->where('severity', '2')
        	    ->count();

        	$low = $reportitems = DB::table('reportitems')
	            ->where('reporthost_id',$each['id'])
    	        ->where('severity', '0')
        	    ->count();          
			    
        	// return [$high,$med,$low];

        	// Not working on $each maybe coz $each is treated as set hi=olding values on array    
        	// $each['high'] = $high;
        	// $each['med'] = $med;
        	// $each['low'] = $low;

        	// Pushing element without key.    
        	// array_push($reporthosts[$key], $high);
        	$reporthosts[$key]['high'] = $high;    
        	$reporthosts[$key]['med']  = $med;    
        	$reporthosts[$key]['low']  = $low;    

        }

        return $reporthosts;

        // Using query builder where function to return count of high severity vulnerabilities
        // return $reporthosts = DB::table('reporthosts')
        //     ->join('reportitems', 'reporthosts.id', '=', 'reportitems.reporthost_id')
        //     ->select('reporthosts.host_ip', 
        //     		DB::raw('count(*) as total')
        //     		//, DB::raw("SELECT count(severity) as high FROM reporthosts WHERE plugin_name = '$someVariable'")
        //     		)
        //     ->where('reporthosts.host_ip','$each->host_ip')
        //     ->where('reportitems.severity', '4')
        //     // ->groupBy('reporthosts.host_ip')
        //     // ->orderBy('total','DESC')       
        //     ->get();    

	}

	public function get_most_vulnerable_assets(){

		$new_array = [];
		$array = Reporthost::all();
		foreach($array as $each){

			$count = Reportitem::where('reporthost_id', $each->id)->count();
			// $new_array[$each->id] = [$count];
			if($each->mac != 'NULL'){
				$new_array[$each->id] = ["id" => $each->id,
										 "ip" => $each->host_ip, 
										 "mac" => $each->mac,
										 "system_type" => $each->system_type,
										 "operating_system" => $each->operating_system,
										 "count" => $count
										 ];
			}else{

				$new_array[$each->id] = ["id" => $each->id,
										 "ip" => $each->host_ip, 
										 "mac" => $each->os,
										 "system_type" => $each->system_type,
										 "operating_system" => $each->operating_system,
										 "count" => $count
										 ];				

			}

		}

		return $new_array;

	}


	public function ip_mac_by_reporthost_id($reporthost_id){

		return Reporthost::where('id', $reporthost_id)->get();

	}

	public function reportfile(){
		return $this->belongsTo('App\Reportfile');
	}

    public function reportitem(){

    	return $this->hasMany('App\Reportitem');

    }
}
