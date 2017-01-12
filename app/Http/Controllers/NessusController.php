<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadNessusRequest;

use App\Pluginid;

use App\Reporthost;

use App\Reportitem;

use App\User;

use App\Role;

use App\Phase;

use App\Task;

use App\Reportfile;

use App\Project;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\File;

use phpoffice\phpword;

use Session;

use Fpdf;

use Auth;


class NessusController extends Controller
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


    public function create_user(){

        User::create([
            'name'      => 'Muhammad',
            'email'     => 'muhammad@yahoo.com',
            'password'  => 'something',
            ]);
        User::create([
            'name'      => 'Faisal',
            'email'     => 'faisal@yahoo.com',
            'password'  => 'something',
            ]);
        User::create([
            'name'      => 'Labeeb',
            'email'     => 'labeeb@yahoo.com',
            'password'  => 'something',
            ]);
        User::create([
            'name'      => 'Mustafa',
            'email'     => 'mustafa@yahoo.com',
            'password'  => 'something',
            ]);


        Role::create([
            'name' => 'Client Representative',
            ]);

        $phase_one = Phase::create([
            'name' => 'Pre-engagement',
            'is_default' => '1'
            ]);
        Task::create([
            'name' => 'First Task',
            'phase_id' => $phase_one->id,
            ]);
        Task::create([
            'name' => 'Second Task',
            'phase_id' => $phase_one->id,
            ]);

        $phase_two = Phase::create([
            'name' => 'Engagement',
            'is_default' => '1'
            ]);
        Task::create([
            'name' => 'First Task',
            'phase_id' => $phase_two->id,
            ]);
        Task::create([
            'name' => 'Second Task',
            'phase_id' => $phase_two->id,
            ]);


        $phase_three = Phase::create([
            'name' => 'Post-engagement',
            'is_default' => '1'
            ]);
        Task::create([
            'name' => 'First Task',
            'phase_id' => $phase_three->id,
            ]);
        Task::create([
            'name' => 'Second Task',
            'phase_id' => $phase_three->id,
            ]);


        $phase_four = Phase::create([
            'name' => 'Reconnaisance',
            'is_default' => '1'
            ]);
        Task::create([
            'name' => 'First Task',
            'phase_id' => $phase_four->id,
            ]);
        Task::create([
            'name' => 'Second Task',
            'phase_id' => $phase_four->id,
            ]);


    }

    public function upload(UploadNessusRequest $request){

            $reportfile = Reportfile::store($request->name, $request->project, $request->information, Auth::user()->id);

            $nessus_file_upload = $request->file('nessus_file_upload');
            $nessus_content = File::get($request->file('nessus_file_upload'));

            $this->save_plugin_id($nessus_content, $reportfile->id); 

            // echo "<pre>";
            // var_dump($display);
            // echo "</pre>";

            $this->save_reporthosts_and_reportitems($nessus_content, $reportfile->id); 

            return \Redirect::route('file_upload')->with('message', 'Nessus File Parsed and Stored in Database');

    }

    public function save_plugin_id($nessus_content, $reportfile_id){


        //----------------------- Report Plugin Id set Parsing ---------------------------// 

            $nessus = $nessus_content;
            $xml    = simplexml_load_string($nessus);
            $json   = json_encode($xml);
            $nessus = json_decode($json,TRUE);
     
           $pluginid_count = Pluginid::count('id');

            foreach($nessus['Policy']['Preferences']['ServerPreferences']['preference'] as $something){
               
                if($something['name'] == 'plugin_set'){
                  
                    $plugin_id_array = explode(';',$something['value']);
                    array_pop($plugin_id_array);
                    // echo '<pre>';
                    // print_r($plugin_id_array);
                    // echo '</pre>';
                    if(sizeof($plugin_id_array) != $pluginid_count){
    
                        Pluginid::store($plugin_id_array, $reportfile_id);

                    }
    
                }
    
            }
            

    }

    public function save_reporthosts_and_reportitems($nessus_content, $reportfile_id){

            $reading = $nessus_content;

            preg_match_all("#<\s*?ReportHost\b[^>]*>(.*?)</ReportHost\b[^>]*>#s", $reading, $reporthosts);
            
            // Loop through each Reporthost (IP)
            foreach($reporthosts[1] as $reporthost){
                    
                $this->parse_data($reporthost, $reportfile_id);
                
            }


    }

    
    public function parse_data($reporthost, $reportfile_id){


        //----------------------- ReportHost Metadata Parsing ---------------------------//

            $reporthost_metadata = [];

            // Host IP
            $result_host_ip = preg_match('#(?<=("host-ip">))((?:.|\n)*?)(?=</tag)#', $reporthost, $host_ip);

            if($result_host_ip){

                $reporthost_metadata['host_ip'] = $host_ip[0];

            }else{

                $reporthost_metadata['host_ip'] = 'NULL';

            }

            // Mac Address
            $result_mac = preg_match('#(?<=("mac-address">))((?:.|\n)*?)(?=</tag)#', $reporthost, $mac);

            if($result_mac){

                $reporthost_metadata['mac'] = $mac[0];        
            
            }else{

                $reporthost_metadata['mac'] = 'NULL';

            }

            // OS
            $result_os = preg_match('#(?<=("os">))((?:.|\n)*?)(?=</tag)#', $reporthost, $os);

            if($result_os){

                $reporthost_metadata['os'] = $os[0];

            }else{

                $reporthost_metadata['os'] = 'NULL';

            }

            // System Type
            $result_system_type = preg_match('#(?<=("system-type">))((?:.|\n)*?)(?=</tag)#', $reporthost, $system_type);
            if($result_system_type){

                $reporthost_metadata['system_type'] = $system_type[0];
            
            }else{

                $reporthost_metadata['system_type'] = 'NULL';
            
            }            

            // Operating System
            $result_operating_system = preg_match('#(?<=("operating-system">))((?:.|\n)*?)(?=</tag)#', $reporthost, $operating_system);
            if($result_operating_system){

                $reporthost_metadata['operating_system'] = $operating_system[0];

            }else{

                $reporthost_metadata['operating_system'] = 'NULL';

            }

            // CPE-1
            $result_cpe_1 = preg_match('#(?<=("cpe-1">))((?:.|\n)*?)(?=</tag)#', $reporthost, $cpe_1);
            if($result_cpe_1){

                $reporthost_metadata['cpe_1'] = $cpe_1[0];

            }else{

                $reporthost_metadata['cpe_1'] = 'NULL';

            } 

            // Host End
            $result_host_end = preg_match('#(?<=("HOST_END">))((?:.|\n)*?)(?=</tag)#', $reporthost, $host_end);
            if($result_host_end){

                $reporthost_metadata['host_end'] = $host_end[0];

            }else{

                $reporthost_metadata['host_end'] = 'NULL';

            }                       

            // Last Unauthenticated Results
            $result_last_unauthenticated_results = preg_match('#(?<=("LastUnauthenticatedResults">))((?:.|\n)*?)(?=</tag)#', $reporthost, $last_unauthenticated_results);
            if($result_last_unauthenticated_results){

                $reporthost_metadata['last_unauthenticated_results'] = $last_unauthenticated_results[0];

            }else{

                $reporthost_metadata['last_unauthenticated_results'] = 'NULL';

            }                       

            // Credentialed Scan
            $result_credentialed_scan = preg_match('#(?<=("Credentialed_Scan">))((?:.|\n)*?)(?=</tag)#', $reporthost, $credentialed_scan);
            if($result_credentialed_scan){

                $reporthost_metadata['credentialed_scan'] = $credentialed_scan[0];

            }else{

                $reporthost_metadata['credentialed_scan'] = 'NULL';

            }   

            // Policy Name Used
            $result_policy_name = preg_match('#(?<=("policy-used">))((?:.|\n)*?)(?=</tag)#', $reporthost, $policy_name);
            if($result_policy_name){

                $reporthost_metadata['policy_name'] = $policy_name[0];

            }else{

                $reporthost_metadata['policy_name'] = 'NULL';

            }   

            // Patch Summary Total CVES
            $result_total_cves = preg_match('#(?<=("patch-summary-total-cves">))((?:.|\n)*?)(?=</tag)#', $reporthost, $total_cves);
            if($result_total_cves){

                $reporthost_metadata['total_cves'] = $total_cves[0];

            }else{

                $reporthost_metadata['total_cves'] = 'NULL';

            } 

            // CPE
            $result_cpe = preg_match('#(?<=("cpe">))((?:.|\n)*?)(?=</tag)#', $reporthost, $cpe);
            if($result_cpe){

                $reporthost_metadata['cpe'] = $cpe[0];

            }else{

                $reporthost_metadata['cpe'] = 'NULL';

            } 

            // CPE_0
            $result_cpe_0 = preg_match('#(?<=("cpe-0">))((?:.|\n)*?)(?=</tag)#', $reporthost, $cpe_0);
            if($result_cpe_0){

                $reporthost_metadata['cpe_0'] = $cpe_0[0];

            }else{

                $reporthost_metadata['cpe_0'] = 'NULL';

            } 

            // traceroute_hop_0
            $result_traceroute_hop_0 = preg_match('#(?<=("traceroute-hop-0">))((?:.|\n)*?)(?=</tag)#', $reporthost, $traceroute_hop_0);
            if($result_traceroute_hop_0){

                $reporthost_metadata['traceroute_hop_0'] = $traceroute_hop_0[0];

            }else{

                $reporthost_metadata['traceroute_hop_0'] = 'NULL';

            } 
            
            // traceroute_hop_1
            $result_traceroute_hop_1 = preg_match('#(?<=("traceroute-hop-1">))((?:.|\n)*?)(?=</tag)#', $reporthost, $traceroute_hop_1);
            if($result_traceroute_hop_1){

                $reporthost_metadata['traceroute_hop_1'] = $traceroute_hop_1[0];

            }else{

                $reporthost_metadata['traceroute_hop_1'] = 'NULL';

            } 

            // traceroute_hop_2
            $result_traceroute_hop_2 = preg_match('#(?<=("traceroute-hop-2">))((?:.|\n)*?)(?=</tag)#', $reporthost, $traceroute_hop_2);
            if($result_traceroute_hop_2){

                $reporthost_metadata['traceroute_hop_2'] = $traceroute_hop_2[0];

            }else{

                $reporthost_metadata['traceroute_hop_2'] = 'NULL';

            }

            // traceroute_hop_3
            $result_traceroute_hop_3 = preg_match('#(?<=("traceroute-hop-3">))((?:.|\n)*?)(?=</tag)#', $reporthost, $traceroute_hop_3);
            if($result_traceroute_hop_3){

                $reporthost_metadata['traceroute_hop_3'] = $traceroute_hop_3[0];

            }else{

                $reporthost_metadata['traceroute_hop_3'] = 'NULL';

            }

            // traceroute_hop_4
            $result_traceroute_hop_4 = preg_match('#(?<=("traceroute-hop-4">))((?:.|\n)*?)(?=</tag)#', $reporthost, $traceroute_hop_4);
            if($result_traceroute_hop_4){

                $reporthost_metadata['traceroute_hop_4'] = $traceroute_hop_4[0];

            }else{

                $reporthost_metadata['traceroute_hop_4'] = 'NULL';

            }                                     

            // Netbios Name
            $result_netbios_name = preg_match('#(?<=("netbios-name">))((?:.|\n)*?)(?=</tag)#', $reporthost, $netbios_name);
            if($result_netbios_name){

                $reporthost_metadata['netbios_name'] = $netbios_name[0];

            }else{

                $reporthost_metadata['netbios_name'] = 'NULL';

            }             

            // Host Start
            $result_host_start = preg_match('#(?<=("HOST_START">))((?:.|\n)*?)(?=</tag)#', $reporthost, $host_start);
            if($result_host_start){

                $reporthost_metadata['host_start'] = $host_start[0];

            }else{

                $reporthost_metadata['host_start'] = 'NULL';

            }        

            // ssh-fingerprint
            $result_ssh_fingerprint = preg_match('#(?<=("ssh-fingerprint">))((?:.|\n)*?)(?=</tag)#', $reporthost, $ssh_fingerprint);
            if($result_ssh_fingerprint){

                $reporthost_metadata['ssh_fingerprint'] = $ssh_fingerprint[0];

            }else{

                $reporthost_metadata['ssh_fingerprint'] = 'NULL';

            }  

            // Host-FQDN
            $result_host_fqdn = preg_match('#(?<=("host-fqdn">))((?:.|\n)*?)(?=</tag)#', $reporthost, $host_fqdn);
            if($result_host_fqdn){

                $reporthost_metadata['host_fqdn'] = $host_fqdn[0];

            }else{

                $reporthost_metadata['host_fqdn'] = 'NULL';

            }  

            
            $ReportHost = new Reporthost();
            $lastinsertedid = $ReportHost->store($reporthost_metadata, $reportfile_id);


            // return $reporthost_metadata;
            // return $reporthost;


        //----------------------- Report Items Parsing ---------------------------//  

            $reportitems = [];
            
            // ---- XML to JSON ---- //        
            $reporthost = "<ReportHost>".$reporthost."</ReportHost>";
            $xml    = simplexml_load_string($reporthost);
            $json   = json_encode($xml);
            $nessus = json_decode($json,TRUE);


            foreach($nessus['ReportItem'] as $reportitem){

                    // Report Item - Port
                    $reportitems['port'] = $reportitem['@attributes']['port'];

                    // Report Item - Service name
                    $reportitems['svc_name'] = $reportitem['@attributes']['svc_name'];

                    // Report Item - Protocol
                    $reportitems['protocol'] = $reportitem['@attributes']['protocol'];

                    // Report Item - Severity
                    $reportitems['severity'] = $reportitem['@attributes']['severity'];

                    // Report Item - Plugin ID
                    $reportitems['plugin_id'] = $reportitem['@attributes']['pluginID'];

                    // Report Item - Plugin Name
                    $reportitems['plugin_name'] = $reportitem['@attributes']['pluginName'];

                    // Report Item - Plugin Family
                    $reportitems['plugin_family'] = $reportitem['@attributes']['pluginFamily'];

                    // Report Item - Description
                    $reportitems['description'] = $reportitem['description'];

                    // Report Item - Fname
                    $reportitems['fname'] = $reportitem['fname'];

                    // Report Item - Plugin Type
                    $reportitems['plugin_type'] = $reportitem['plugin_type'];

                    // Report Item - Risk Factor
                    $reportitems['risk_factor'] = $reportitem['risk_factor'];

                    // Report Item - Solution
                    $reportitems['solution'] = $reportitem['solution'];

                    // Report Item - Synopsis
                    $reportitems['synopsis'] = $reportitem['synopsis'];

                    // Report Item - Plugin Output
                    if(!empty($reportitem['plugin_output'])){
                        $reportitems['plugin_output'] = $reportitem['plugin_output'];
                    }else{
                        $reportitems['plugin_output'] = 'NULL';
                    }

                    // Report Item - Id of last inserted reporthost meta-data
                    $reportitems['lastinsertedid'] = $lastinsertedid;

                    $ReportItem = new Reportitem();
                    $ReportItem->store($reportitems);

            }


    }




    public function array_orderby(){

        // Array_orderBy used in First Table of Word and Pdf to order by Count

            $args = func_get_args();
            $data = array_shift($args);
            foreach ($args as $n => $field) {
                if (is_string($field)) {
                    $tmp = array();
                    foreach ($data as $key => $row)
                        $tmp[$key] = $row[$field];
                    $args[$n] = $tmp;
                    }
            }
            $args[] = &$data;
            call_user_func_array('array_multisort', $args);
            return array_pop($args);
    
    }








    public function reports(){

        $user = Auth::user();

        // If user is a manager or suepr manager
        if($user->role()->where('name', 'Manager')->orWhere('name', 'Super Manager')->exists() ){

            $projects = Project::all();
        
        }
        else{

           $users_projects = $user->project()->get();
           $project_ids = $users_projects->lists('pivot.project_id');
           $projects = Project::whereIn('id', $project_ids)->get();
            
        }
        return view('reports', compact('projects'));

    }    





    public function generate_report(Request $request){

        $report_items = $request->report;
        $report_table = $request->table;
        if(is_null($report_table)){
            return back();
        }


        if($request->word){

            $project_id = $request->project_id[sizeof($request->project_id)-1];
            $reportfiles = Reportfile::where('project_id', $project_id)->get();
            $reportfile_ids = $reportfiles->lists('id');


            if(Reporthost::whereIn('reportfile_id', $reportfile_ids)->count() == 0){

                return \Redirect::route('file_upload')->with('message','Please upload a nessus report file');

            }
            else{


                // ---------------- PHPWord ---------------------- //    
            
                    // $reading = File::get(public_path('includes/nessus_input_file/faisal_sc.nessus'));
                    // \PhpOffice\PhpWord\Autoloader::register();  
                    $phpWord = new \PhpOffice\PhpWord\PhpWord();
                    $phpWord->setDefaultFontName('Times New Roman');
                    $phpWord->setDefaultFontSize(12);

                    $section = $phpWord->createSection();

                    $section->addText('CSAS Report.',array('align'=>'center', 'name' => 'Arial', 'size' => 16, 'bold'=>true, 'color'=>'FB0009') );
                    $section->addTextBreak(1);


                    // -------- Custom Styles -------/    
                        $tableStyle = array(
                            'borderColor' => '050002',
                            'borderSize'  => 6
                            // 'cellMargin'  => 50
                        );
                        $firstRowStyle = array('bgColor' => 'a8a8a8');
                        $phpWord->addTableStyle('myTable', $tableStyle, $firstRowStyle);
                        // $table = $section->addTable('myTable');



                        $centered = array('align'=>'center', 'color'=>'050002', 'bold' => true, 'size' =>12, 'name' => 'Arial');
                        $centered_small = array('align'=>'center', 'color'=>'050002', 'size' =>12, 'name' => 'Arial');
                        $left = array('align'=>'left', 'color'=>'050002', 'bold' => true, 'size' =>12, 'name' => 'Arial');
                        $left_10 = array('align'=>'left', 'color'=>'050002', 'bold' => true, 'size' =>10, 'name' => 'Arial');
                        $left_10_wb = array('align'=>'left', 'color'=>'050002', 'size' =>10, 'name' => 'Arial');
                        $center = array('align'=>'left', 'color'=>'050002', 'size' =>12, 'name' => 'Arial');                    


                if(in_array("table1", $report_table)){        
                        
                    // ------------------ Table 1 Data Fetch ----------------------//

                        $Reporthost = new Reporthost();
                        $most_vulnerable_assets = $Reporthost->get_most_vulnerable_assets($project_id);

                        // $new_array = array();
                        // foreach ($most_vulnerable_assets as $key => $value)
                        // {
                            // $new_array[$key] = $value['count'] 
                            // $new_array[] = $value['4'];

                        // }
                        // array_multisort($new_array, SORT_DESC, $most_vulnerable_assets);

                        $most_vulnerable_assets = $this->array_orderby($most_vulnerable_assets, 'count', SORT_DESC);

                        // echo '<pre>';
                        // var_dump($most_vulnerable_assets);
                        // echo '</pre>';

                    
                   
                    //------------------------- Table 1 - 4 Selected -------------------------------------- //

                        if(in_array("IP Address 1", $report_items) && in_array("MAC Address 1", $report_items) && in_array("Asset Type", $report_items) &&  in_array("Vulnerability Count", $report_items))
                        {


                            // ------------------- PHPWORD Table 1 --------------------------------------//



                                $table = $section->addTable('myTable');
                                $table->addRow(450);
                                $table->addCell(1000, $firstRowStyle)->addText('Sr.', $centered, array('align' => 'center'));
                                $table->addCell(2500, $firstRowStyle)->addText('IP Address', $centered, array('align' => 'center'));
                                $table->addCell(3000, $firstRowStyle)->addText('MAC Address', $centered, array('align' => 'center'));
                                $table->addCell(3500, $firstRowStyle)->addText('Asset Type*', $centered, array('align' => 'center'));
                                $table->addCell(2500, $firstRowStyle)->addText('Count', $centered, array('align' => 'center'));

                                // $table_1 = $section->addTable();

                                $j = 1;
                                foreach($most_vulnerable_assets as $host_property){
                                    $table->addRow();
                                    $table->addCell(1000)->addText($j.'.');
                                    $table->addCell(2500)->addText($host_property['ip'], array('bold'=>true));
                                    $table->addCell(3000)->addText($host_property['mac']);
                                    $table->addCell(3000)->addText($host_property['system_type'].'                                        '.$host_property['operating_system']);
                                    $table->addCell(2500)->addText($host_property['count'], $centered_small, array('align' => 'center'));

                                    $j = $j+1;

                                }
                                $section->addTextBreak(1);

                                $section->addText('TABLE 1: List of most vulnerable assets in the client’s network ',array('name' => 'Arial', 'size' => 10, 'color'=>'FB0009', 'bold'=>true, 'lineHeight'=>-15) );
                                // $section->addText(' ',array('name' => 'Arial', 'size' => 10, 'color'=>'FB0009', 'bold'=>true, 'lineHeight'=>0.1) );
                                $section->addTextBreak(1, array('lineHeight'=>-15));
                                $section->addText('Facility to be decided form the subnet defined by the analyst.',array('name' => 'Arial', 'size' => 9, 'color'=>'050002', 'lineHeight'=>-15) );
                                $section->addTextBreak(1);

                                $section->addPageBreak();


                                
                        }


                    //------------------------- Table 1 - 3 Selected -------------------------------------- //

                        elseif(in_array("IP Address 1", $report_items) && in_array("MAC Address 1", $report_items) && in_array("Asset Type", $report_items) )
                        {
                            
                            // ------------------- PHPWORD Table 1 --------------------------------------//



                                $table = $section->addTable('myTable');
                                $table->addRow(450);
                                $table->addCell(1000, $firstRowStyle)->addText('Sr.', $centered, array('align' => 'center'));
                                $table->addCell(2500, $firstRowStyle)->addText('IP Address', $centered, array('align' => 'center'));
                                $table->addCell(3000, $firstRowStyle)->addText('MAC Address', $centered, array('align' => 'center'));
                                $table->addCell(3500, $firstRowStyle)->addText('Asset Type*', $centered, array('align' => 'center'));


                                $j = 1;
                                foreach($most_vulnerable_assets as $host_property){
                                    $table->addRow();
                                    $table->addCell(1000)->addText($j.'.');
                                    $table->addCell(2500)->addText($host_property['ip'], array('bold'=>true));
                                    $table->addCell(3000)->addText($host_property['mac']);
                                    $table->addCell(3000)->addText($host_property['system_type'].'                                        '.$host_property['operating_system']);

                                    $j = $j+1;

                                }
                                $section->addTextBreak(1);

                                $section->addText('TABLE 1: List of most vulnerable assets in the client’s network ',array('name' => 'Arial', 'size' => 10, 'color'=>'FB0009', 'bold'=>true, 'lineHeight'=>-15) );
                                // $section->addText(' ',array('name' => 'Arial', 'size' => 10, 'color'=>'FB0009', 'bold'=>true, 'lineHeight'=>0.1) );
                                $section->addTextBreak(1, array('lineHeight'=>-15));
                                $section->addText('Facility to be decided form the subnet defined by the analyst.',array('name' => 'Arial', 'size' => 9, 'color'=>'050002', 'lineHeight'=>-15) );
                                $section->addTextBreak(1);

                                $section->addPageBreak();


                        }

                        elseif(in_array("IP Address 1", $report_items) && in_array("MAC Address 1", $report_items) && in_array("Vulnerability Count", $report_items) )
                        {


                            // ------------------- PHPWORD Table 1 --------------------------------------//


                                $table = $section->addTable('myTable');
                                $table->addRow(450);
                                $table->addCell(1000, $firstRowStyle)->addText('Sr.', $centered, array('align' => 'center'));
                                $table->addCell(2500, $firstRowStyle)->addText('IP Address', $centered, array('align' => 'center'));
                                $table->addCell(3000, $firstRowStyle)->addText('MAC Address', $centered, array('align' => 'center'));
                                $table->addCell(2500, $firstRowStyle)->addText('Count', $centered, array('align' => 'center'));


                                $j = 1;
                                foreach($most_vulnerable_assets as $host_property){
                                    $table->addRow();
                                    $table->addCell(1000)->addText($j.'.');
                                    $table->addCell(2500)->addText($host_property['ip'], array('bold'=>true));
                                    $table->addCell(3000)->addText($host_property['mac']);
                                    $table->addCell(2500)->addText($host_property['count'], $centered_small, array('align' => 'center'));

                                    $j = $j+1;

                                }
                                $section->addTextBreak(1);

                                $section->addText('TABLE 1: List of most vulnerable assets in the client’s network ',array('name' => 'Arial', 'size' => 10, 'color'=>'FB0009', 'bold'=>true, 'lineHeight'=>-15) );
                                // $section->addText(' ',array('name' => 'Arial', 'size' => 10, 'color'=>'FB0009', 'bold'=>true, 'lineHeight'=>0.1) );
                                $section->addTextBreak(1, array('lineHeight'=>-15));
                                $section->addText('Facility to be decided form the subnet defined by the analyst.',array('name' => 'Arial', 'size' => 9, 'color'=>'050002', 'lineHeight'=>-15) );
                                $section->addTextBreak(1);

                                $section->addPageBreak();


                        
                        }

                        elseif(in_array("IP Address 1", $report_items) && in_array("Asset Type", $report_items) && in_array("Vulnerability Count", $report_items) )
                        {
                            

                            // ------------------- PHPWORD Table 1 --------------------------------------//



                                $table = $section->addTable('myTable');
                                $table->addRow(450);
                                $table->addCell(1000, $firstRowStyle)->addText('Sr.', $centered, array('align' => 'center'));
                                $table->addCell(2500, $firstRowStyle)->addText('IP Address', $centered, array('align' => 'center'));
                                $table->addCell(3500, $firstRowStyle)->addText('Asset Type*', $centered, array('align' => 'center'));
                                $table->addCell(2500, $firstRowStyle)->addText('Count', $centered, array('align' => 'center'));


                                $j = 1;
                                foreach($most_vulnerable_assets as $host_property){
                                    $table->addRow();
                                    $table->addCell(1000)->addText($j.'.');
                                    $table->addCell(2500)->addText($host_property['ip'], array('bold'=>true));
                                    $table->addCell(3000)->addText($host_property['system_type'].'                                        '.$host_property['operating_system']);
                                    $table->addCell(2500)->addText($host_property['count'], $centered_small, array('align' => 'center'));

                                    $j = $j+1;

                                }
                                $section->addTextBreak(1);

                                $section->addText('TABLE 1: List of most vulnerable assets in the client’s network ',array('name' => 'Arial', 'size' => 10, 'color'=>'FB0009', 'bold'=>true, 'lineHeight'=>-15) );
                                // $section->addText(' ',array('name' => 'Arial', 'size' => 10, 'color'=>'FB0009', 'bold'=>true, 'lineHeight'=>0.1) );
                                $section->addTextBreak(1, array('lineHeight'=>-15));
                                $section->addText('Facility to be decided form the subnet defined by the analyst.',array('name' => 'Arial', 'size' => 9, 'color'=>'050002', 'lineHeight'=>-15) );
                                $section->addTextBreak(1);

                                $section->addPageBreak();


                   
                        
                        }


                    //------------------------- Table 1 - 2 Selected -------------------------------------- //

                        elseif(in_array("IP Address 1", $report_items) && in_array("MAC Address 1", $report_items) )
                        {
                            

                            // ------------------- PHPWORD Table 1 --------------------------------------//



                                $table = $section->addTable('myTable');
                                $table->addRow(450);
                                $table->addCell(1000, $firstRowStyle)->addText('Sr.', $centered, array('align' => 'center'));
                                $table->addCell(2500, $firstRowStyle)->addText('IP Address', $centered, array('align' => 'center'));
                                $table->addCell(3000, $firstRowStyle)->addText('MAC Address', $centered, array('align' => 'center'));


                                $j = 1;
                                foreach($most_vulnerable_assets as $host_property){
                                    $table->addRow();
                                    $table->addCell(1000)->addText($j.'.');
                                    $table->addCell(2500)->addText($host_property['ip'], array('bold'=>true));
                                    $table->addCell(3000)->addText($host_property['mac']);

                                    $j = $j+1;

                                }
                                $section->addTextBreak(1);

                                $section->addText('TABLE 1: List of most vulnerable assets in the client’s network ',array('name' => 'Arial', 'size' => 10, 'color'=>'FB0009', 'bold'=>true, 'lineHeight'=>-15) );
                                // $section->addText(' ',array('name' => 'Arial', 'size' => 10, 'color'=>'FB0009', 'bold'=>true, 'lineHeight'=>0.1) );
                                $section->addTextBreak(1, array('lineHeight'=>-15));
                                $section->addText('Facility to be decided form the subnet defined by the analyst.',array('name' => 'Arial', 'size' => 9, 'color'=>'050002', 'lineHeight'=>-15) );
                                $section->addTextBreak(1);

                                $section->addPageBreak();


           
                        
                        }

                        elseif(in_array("IP Address 1", $report_items) && in_array("Asset Type", $report_items) )
                        {
                            

                            // ------------------- PHPWORD Table 1 --------------------------------------//



                                $table = $section->addTable('myTable');
                                $table->addRow(450);
                                $table->addCell(1000, $firstRowStyle)->addText('Sr.', $centered, array('align' => 'center'));
                                $table->addCell(2500, $firstRowStyle)->addText('IP Address', $centered, array('align' => 'center'));
                                $table->addCell(3500, $firstRowStyle)->addText('Asset Type*', $centered, array('align' => 'center'));


                                $j = 1;
                                foreach($most_vulnerable_assets as $host_property){
                                    $table->addRow();
                                    $table->addCell(1000)->addText($j.'.');
                                    $table->addCell(2500)->addText($host_property['ip'], array('bold'=>true));
                                    $table->addCell(3000)->addText($host_property['system_type'].'                                        '.$host_property['operating_system']);

                                    $j = $j+1;

                                }
                                $section->addTextBreak(1);

                                $section->addText('TABLE 1: List of most vulnerable assets in the client’s network ',array('name' => 'Arial', 'size' => 10, 'color'=>'FB0009', 'bold'=>true, 'lineHeight'=>-15) );
                                // $section->addText(' ',array('name' => 'Arial', 'size' => 10, 'color'=>'FB0009', 'bold'=>true, 'lineHeight'=>0.1) );
                                $section->addTextBreak(1, array('lineHeight'=>-15));
                                $section->addText('Facility to be decided form the subnet defined by the analyst.',array('name' => 'Arial', 'size' => 9, 'color'=>'050002', 'lineHeight'=>-15) );
                                $section->addTextBreak(1);

                                $section->addPageBreak();


                  
                        
                        }

                        elseif(in_array("IP Address 1", $report_items) && in_array("Vulnerability Count", $report_items))
                        {
                            

                            // ------------------- PHPWORD Table 1 --------------------------------------//



                                $table = $section->addTable('myTable');
                                $table->addRow(450);
                                $table->addCell(1000, $firstRowStyle)->addText('Sr.', $centered, array('align' => 'center'));
                                $table->addCell(2500, $firstRowStyle)->addText('IP Address', $centered, array('align' => 'center'));
                                $table->addCell(2500, $firstRowStyle)->addText('Count', $centered, array('align' => 'center'));


                                $j = 1;
                                foreach($most_vulnerable_assets as $host_property){
                                    $table->addRow();
                                    $table->addCell(1000)->addText($j.'.');
                                    $table->addCell(2500)->addText($host_property['ip'], array('bold'=>true));
                                    $table->addCell(2500)->addText($host_property['count'], $centered_small, array('align' => 'center'));

                                    $j = $j+1;

                                }
                                $section->addTextBreak(1);

                                $section->addText('TABLE 1: List of most vulnerable assets in the client’s network ',array('name' => 'Arial', 'size' => 10, 'color'=>'FB0009', 'bold'=>true, 'lineHeight'=>-15) );
                                // $section->addText(' ',array('name' => 'Arial', 'size' => 10, 'color'=>'FB0009', 'bold'=>true, 'lineHeight'=>0.1) );
                                $section->addTextBreak(1, array('lineHeight'=>-15));
                                $section->addText('Facility to be decided form the subnet defined by the analyst.',array('name' => 'Arial', 'size' => 9, 'color'=>'050002', 'lineHeight'=>-15) );
                                $section->addTextBreak(1);

                                $section->addPageBreak();


           
                        
                        }     


                    //------------------------- Table 1 - 1 Selected -------------------------------------- //

                        elseif(in_array("IP Address 1", $report_items))
                        {
                            

                            // ------------------- PHPWORD Table 1 --------------------------------------//



                                $table = $section->addTable('myTable');
                                $table->addRow(450);
                                $table->addCell(1000, $firstRowStyle)->addText('Sr.', $centered, array('align' => 'center'));
                                $table->addCell(2500, $firstRowStyle)->addText('IP Address', $centered, array('align' => 'center'));


                                $j = 1;
                                foreach($most_vulnerable_assets as $host_property){
                                    $table->addRow();
                                    $table->addCell(1000)->addText($j.'.');
                                    $table->addCell(2500)->addText($host_property['ip'], array('bold'=>true));

                                    $j = $j+1;

                                }
                                $section->addTextBreak(1);

                                $section->addText('TABLE 1: List of most vulnerable assets in the client’s network ',array('name' => 'Arial', 'size' => 10, 'color'=>'FB0009', 'bold'=>true, 'lineHeight'=>-15) );
                                $section->addTextBreak(1, array('lineHeight'=>-15));
                                $section->addText('Facility to be decided form the subnet defined by the analyst.',array('name' => 'Arial', 'size' => 9, 'color'=>'050002', 'lineHeight'=>-15) );
                                $section->addTextBreak(1);
                                $section->addPageBreak();


                
                        
                        }                   

                }        
                
                if(in_array("table2", $report_table)){      

                    // ------------------ Table 2 Data Fetch ----------------------//

                        $Reportitem = new Reportitem();
                        $vulnerabilities = $Reportitem->get_vulnerabilities($project_id);
                        

                    //------------------------- Table 2 - 2 Selected -------------------------------------- //

                        if(in_array("Exploit Category", $report_items) && in_array("Infected Assets Count", $report_items)){

                            //------------------- PHP WORD Table 2 --------------------------------------//

                                $section->addText('TABLE 2: Top 10 Vulnerability names with its total count / occurrence',array('name' => 'Arial', 'size' => 10, 'color'=>'FB0009', 'bold'=>true) );
                                $table2 = $section->addTable('myTable');
                                $table2->addRow();
                                $table2->addCell(15000, $firstRowStyle)->addText('Exploit Category', $left, array('align' => 'left'));
                                $table2->addCell(4500, $firstRowStyle)->addText('Infected Assets', $left, array('align' => 'left'));


                                $counter=0;

                                foreach($vulnerabilities as $each){
                                    if($counter<10){
                                        $table2->addRow(100);
                                        $table2->addCell(15000)->addText(htmlspecialchars($each->plugin_name));
                                        $table2->addCell(4500)->addText(htmlspecialchars($each->total), $center, array('align' => 'center'));
                                    }
                                    $counter = $counter + 1;
                                }    


                        }


                    //------------------------- Table 2 - 1 Selected -------------------------------------- //

                        elseif(in_array("Exploit Category", $report_items)){

                            //------------------- PHP WORD Table 2 --------------------------------------//

                                $section->addText('TABLE 2: Top 10 Vulnerability names with its total count / occurrence',array('name' => 'Arial', 'size' => 10, 'color'=>'FB0009', 'bold'=>true) );
                                $table2 = $section->addTable('myTable');
                                $table2->addRow();
                                $table2->addCell(15000, $firstRowStyle)->addText('Exploit Category', $left, array('align' => 'left'));

                                $counter=0;

                                foreach($vulnerabilities as $each){
                                    if($counter<10){
                                        $table2->addRow(100);
                                        $table2->addCell(15000)->addText(htmlspecialchars($each->plugin_name));
                                    }
                                    $counter = $counter + 1;
                                }    

                        }                        

                } 

                if(in_array("table3", $report_table)){             

                    // ------------------ Table 3 Data Fetch -----------------//

                        $Reporthost = new Reporthost();
                        $Reportitem = new Reportitem();

                        // Fetcching all records in reportitems table
                        $vulnerability_details = $Reportitem->read_reportitems_having_unique_reporthost_id($project_id);


                        // Creating new arrays to store data
                        $new_array = array();

                        foreach($vulnerability_details as $detail){

                            // Fetching ip and mac from reporthosts table by reporthost_id from reportitems
                            $reporthosts = $Reporthost->ip_mac_by_reporthost_id($detail->reporthost_id);
     

                            if(!array_key_exists($detail->plugin_name, $new_array)){

                                $new_array[$detail->plugin_name]['plugin_name'] = $detail->plugin_name;
                                $new_array[$detail->plugin_name]['description'] = $detail->description;
                                $new_array[$detail->plugin_name]['solution']    = $detail->solution;
                                
                                foreach($reporthosts as $reporthost){

                                    $new_array[$detail->plugin_name]['ip']      = [$reporthost->host_ip];
                                    $new_array[$detail->plugin_name]['mac']     = [$reporthost->mac];
                                  
                                }
                                    
                            }
                            elseif(array_key_exists($detail->plugin_name, $new_array)){

                                foreach($reporthosts as $reporthost){

                                    array_push($new_array[$detail->plugin_name]['ip'], $reporthost->host_ip);
                                    array_push($new_array[$detail->plugin_name]['mac'], $reporthost->mac);
                                    
             
                                }                        

                            }

                        }    


                    //------------------------- Table 3 - 5 Selected -------------------------------------- //


                        if(in_array("Plugin Name", $report_items) && in_array("Description", $report_items) && in_array("Remediation", $report_items) &&  in_array("IP Address 3", $report_items) &&  in_array("MAC Address 3", $report_items)){

                            //------------------- PHP WORD Table 3 --------------------------------------//

                                $section->addTextBreak(1);
                                $section->addTextBreak(1);
                                $section->addText('TABLE 3: Vulnerability detail with description, remedy(fix), occurrences',array('name' => 'Arial', 'size' => 10, 'color'=>'FB0009', 'bold'=>true, 'lineHeight'=>-15));

                                $section->addTextBreak(1, array('lineHeight'=>-15));
                                $section->addText('All coming from the scan fields', array('name' => 'Arial', 'size' => 9, 'color'=>'050002', 'lineHeight'=>-15));
                                $section->addTextBreak(1);
                                $section->addTextBreak(1);


                                $counter = 1;

                                foreach($new_array as $each){

                                    $section->addText($counter.'. '.htmlspecialchars($each['plugin_name']),array('name' => 'Arial', 'size' => 12, 'color'=>'050002', 'bold'=>true) );
                                    $section->addTextBreak(1);


                                    $table3 = $section->addTable('myTable');
                                    $table3->addRow(100);
                                    $table3->addCell(3000, $firstRowStyle)->addText('Description', array('color'=>'050002', 'bold'=>true, 'size' => 11, 'bgColor' => 'a8a8a8'));
                                    $table3->addCell(13000)->addText($each['description'], array('color'=>'050002', 'size' => 10));



                                    $table3->addRow(100);
                                    $table3->addCell(3000, $firstRowStyle)->addText('Remediation', array('color'=>'050002', 'bold'=>true, 'size' => 11, 'bgColor' => 'a8a8a8'));
                                    $table3->addCell(13000)->addText($each['solution'], array('color'=>'050002', 'size' => 10));
                                







                                    $section->addTextBreak(1);
                                    $section->addText('Following is the list of assets with this vulnerability:',array('name' => 'Arial', 'size' => 10, 'color'=>'050002') );
                                    $section->addTextBreak(1);

                                    $table5 = $section->addTable('myTable');
                                    $table5->addRow(100);
                                    $table5->addCell(2000)->addText('S. No.', $left_10,array('align'=>'left'));
                                    $table5->addCell(8000)->addText('IP', $left_10, array('align'=>'left'));
                                    $table5->addCell(6000)->addText('MAC', $left_10, array('align'=>'left'));
                                    $section->addTextBreak(1);



                                        $j = 1;
                                        $jcount = sizeof($each['ip']);
                                        for($i=0; $i<$jcount; $i++){
                                        // foreach($each['plugin_name'] as $reporthost){
                                        
                                            $table5->addRow(100);
                                            $table5->addCell(2000)->addText($j.' ', $left_10_wb);
                                            $table5->addCell(8000)->addText($each['ip'][$i], $left_10_wb);
                                            $table5->addCell(6000)->addText($each['mac'][$i], $left_10_wb);
                                            $j = $j+1;
                                            
                                        }    


                                        $section->addTextBreak(1);
                                        $section->addTextBreak(1);
                                        $counter = $counter + 1;

                                }


                        }


                    //------------------------- Table 3 - 4 Selected -------------------------------------- //

                        elseif(in_array("Plugin Name", $report_items) && in_array("Description", $report_items) && in_array("Remediation", $report_items) &&  in_array("IP Address 3", $report_items)){



                            //------------------- PHP WORD Table 3 --------------------------------------//

                                $section->addTextBreak(1);
                                $section->addTextBreak(1);
                                $section->addText('TABLE 3: Vulnerability detail with description, remedy(fix), occurrences',array('name' => 'Arial', 'size' => 10, 'color'=>'FB0009', 'bold'=>true, 'lineHeight'=>-15));

                                $section->addTextBreak(1, array('lineHeight'=>-15));
                                $section->addText('All coming from the scan fields', array('name' => 'Arial', 'size' => 9, 'color'=>'050002', 'lineHeight'=>-15));
                                $section->addTextBreak(1);
                                $section->addTextBreak(1);


                                $counter = 1;

                                foreach($new_array as $each){

                                    $section->addText($counter.'. '.htmlspecialchars($each['plugin_name']),array('name' => 'Arial', 'size' => 12, 'color'=>'050002', 'bold'=>true) );
                                    $section->addTextBreak(1);


                                    $table3 = $section->addTable('myTable');
                                    $table3->addRow(100);
                                    $table3->addCell(3000, $firstRowStyle)->addText('Description', array('color'=>'050002', 'bold'=>true, 'size' => 11, 'bgColor' => 'a8a8a8'));
                                    $table3->addCell(13000)->addText($each['description'], array('color'=>'050002', 'size' => 10));



                                    $table3->addRow(100);
                                    $table3->addCell(3000, $firstRowStyle)->addText('Remediation', array('color'=>'050002', 'bold'=>true, 'size' => 11, 'bgColor' => 'a8a8a8'));
                                    $table3->addCell(13000)->addText($each['solution'], array('color'=>'050002', 'size' => 10));
                                







                                    $section->addTextBreak(1);
                                    $section->addText('Following is the list of assets with this vulnerability:',array('name' => 'Arial', 'size' => 10, 'color'=>'050002') );
                                    $section->addTextBreak(1);

                                    $table5 = $section->addTable('myTable');
                                    $table5->addRow(100);
                                    $table5->addCell(2000)->addText('S. No.', $left_10,array('align'=>'left'));
                                    $table5->addCell(8000)->addText('IP', $left_10, array('align'=>'left'));
                                    $section->addTextBreak(1);



                                        $j = 1;
                                        $jcount = sizeof($each['ip']);
                                        for($i=0; $i<$jcount; $i++){
                                        // foreach($each['plugin_name'] as $reporthost){
                                        
                                            $table5->addRow(100);
                                            $table5->addCell(2000)->addText($j.' ', $left_10_wb);
                                            $table5->addCell(8000)->addText($each['ip'][$i], $left_10_wb);
                                            $j = $j+1;
                                            
                                        }    


                                        $section->addTextBreak(1);
                                        $section->addTextBreak(1);
                                        $counter = $counter + 1;

                                }


                        }

                        elseif(in_array("Plugin Name", $report_items) && in_array("Description", $report_items) && in_array("Remediation", $report_items) &&  in_array("MAC Address 3", $report_items)){



                            //------------------- PHP WORD Table 3 --------------------------------------//

                                $section->addTextBreak(1);
                                $section->addTextBreak(1);
                                $section->addText('TABLE 3: Vulnerability detail with description, remedy(fix), occurrences',array('name' => 'Arial', 'size' => 10, 'color'=>'FB0009', 'bold'=>true, 'lineHeight'=>-15));

                                $section->addTextBreak(1, array('lineHeight'=>-15));
                                $section->addText('All coming from the scan fields', array('name' => 'Arial', 'size' => 9, 'color'=>'050002', 'lineHeight'=>-15));
                                $section->addTextBreak(1);
                                $section->addTextBreak(1);


                                $counter = 1;

                                foreach($new_array as $each){

                                    $section->addText($counter.'. '.htmlspecialchars($each['plugin_name']),array('name' => 'Arial', 'size' => 12, 'color'=>'050002', 'bold'=>true) );
                                    $section->addTextBreak(1);


                                    $table3 = $section->addTable('myTable');
                                    $table3->addRow(100);
                                    $table3->addCell(3000, $firstRowStyle)->addText('Description', array('color'=>'050002', 'bold'=>true, 'size' => 11, 'bgColor' => 'a8a8a8'));
                                    $table3->addCell(13000)->addText($each['description'], array('color'=>'050002', 'size' => 10));



                                    $table3->addRow(100);
                                    $table3->addCell(3000, $firstRowStyle)->addText('Remediation', array('color'=>'050002', 'bold'=>true, 'size' => 11, 'bgColor' => 'a8a8a8'));
                                    $table3->addCell(13000)->addText($each['solution'], array('color'=>'050002', 'size' => 10));
                                







                                    $section->addTextBreak(1);
                                    $section->addText('Following is the list of assets with this vulnerability:',array('name' => 'Arial', 'size' => 10, 'color'=>'050002') );
                                    $section->addTextBreak(1);

                                    $table5 = $section->addTable('myTable');
                                    $table5->addRow(100);
                                    $table5->addCell(2000)->addText('S. No.', $left_10,array('align'=>'left'));
                                    $table5->addCell(6000)->addText('MAC', $left_10, array('align'=>'left'));
                                    $section->addTextBreak(1);



                                        $j = 1;
                                        $jcount = sizeof($each['ip']);
                                        for($i=0; $i<$jcount; $i++){
                                        // foreach($each['plugin_name'] as $reporthost){
                                        
                                            $table5->addRow(100);
                                            $table5->addCell(2000)->addText($j.' ', $left_10_wb);
                                            $table5->addCell(6000)->addText($each['mac'][$i], $left_10_wb);
                                            $j = $j+1;
                                            
                                        }    


                                        $section->addTextBreak(1);
                                        $section->addTextBreak(1);
                                        $counter = $counter + 1;

                                }


                        }  

                        elseif(in_array("Plugin Name", $report_items) && in_array("Description", $report_items) &&  in_array("IP Address 3", $report_items) &&  in_array("MAC Address 3", $report_items)){



                            //------------------- PHP WORD Table 3 --------------------------------------//

                                $section->addTextBreak(1);
                                $section->addTextBreak(1);
                                $section->addText('TABLE 3: Vulnerability detail with description, remedy(fix), occurrences',array('name' => 'Arial', 'size' => 10, 'color'=>'FB0009', 'bold'=>true, 'lineHeight'=>-15));

                                $section->addTextBreak(1, array('lineHeight'=>-15));
                                $section->addText('All coming from the scan fields', array('name' => 'Arial', 'size' => 9, 'color'=>'050002', 'lineHeight'=>-15));
                                $section->addTextBreak(1);
                                $section->addTextBreak(1);


                                $counter = 1;

                                foreach($new_array as $each){

                                    $section->addText($counter.'. '.htmlspecialchars($each['plugin_name']),array('name' => 'Arial', 'size' => 12, 'color'=>'050002', 'bold'=>true) );
                                    $section->addTextBreak(1);


                                    $table3 = $section->addTable('myTable');
                                    $table3->addRow(100);
                                    $table3->addCell(3000, $firstRowStyle)->addText('Description', array('color'=>'050002', 'bold'=>true, 'size' => 11, 'bgColor' => 'a8a8a8'));
                                    $table3->addCell(13000)->addText($each['description'], array('color'=>'050002', 'size' => 10));









                                    $section->addTextBreak(1);
                                    $section->addText('Following is the list of assets with this vulnerability:',array('name' => 'Arial', 'size' => 10, 'color'=>'050002') );
                                    $section->addTextBreak(1);

                                    $table5 = $section->addTable('myTable');
                                    $table5->addRow(100);
                                    $table5->addCell(2000)->addText('S. No.', $left_10,array('align'=>'left'));
                                    $table5->addCell(8000)->addText('IP', $left_10, array('align'=>'left'));
                                    $table5->addCell(6000)->addText('MAC', $left_10, array('align'=>'left'));
                                    $section->addTextBreak(1);



                                        $j = 1;
                                        $jcount = sizeof($each['ip']);
                                        for($i=0; $i<$jcount; $i++){
                                        // foreach($each['plugin_name'] as $reporthost){
                                        
                                            $table5->addRow(100);
                                            $table5->addCell(2000)->addText($j.' ', $left_10_wb);
                                            $table5->addCell(8000)->addText($each['ip'][$i], $left_10_wb);
                                            $table5->addCell(6000)->addText($each['mac'][$i], $left_10_wb);
                                            $j = $j+1;
                                            
                                        }    


                                        $section->addTextBreak(1);
                                        $section->addTextBreak(1);
                                        $counter = $counter + 1;

                                }


                        } 

                        elseif(in_array("Plugin Name", $report_items) && in_array("Remediation", $report_items) &&  in_array("IP Address 3", $report_items) &&  in_array("MAC Address 3", $report_items)){



                            //------------------- PHP WORD Table 3 --------------------------------------//

                                $section->addTextBreak(1);
                                $section->addTextBreak(1);
                                $section->addText('TABLE 3: Vulnerability detail with description, remedy(fix), occurrences',array('name' => 'Arial', 'size' => 10, 'color'=>'FB0009', 'bold'=>true, 'lineHeight'=>-15));

                                $section->addTextBreak(1, array('lineHeight'=>-15));
                                $section->addText('All coming from the scan fields', array('name' => 'Arial', 'size' => 9, 'color'=>'050002', 'lineHeight'=>-15));
                                $section->addTextBreak(1);
                                $section->addTextBreak(1);


                                $counter = 1;

                                foreach($new_array as $each){

                                    $section->addText($counter.'. '.htmlspecialchars($each['plugin_name']),array('name' => 'Arial', 'size' => 12, 'color'=>'050002', 'bold'=>true) );
                                    $section->addTextBreak(1);


                                    $table3 = $section->addTable('myTable');
                                    $table3->addRow(100);




                                    $table3->addRow(100);
                                    $table3->addCell(3000, $firstRowStyle)->addText('Remediation', array('color'=>'050002', 'bold'=>true, 'size' => 11, 'bgColor' => 'a8a8a8'));
                                    $table3->addCell(13000)->addText($each['solution'], array('color'=>'050002', 'size' => 10));
                                







                                    $section->addTextBreak(1);
                                    $section->addText('Following is the list of assets with this vulnerability:',array('name' => 'Arial', 'size' => 10, 'color'=>'050002') );
                                    $section->addTextBreak(1);

                                    $table5 = $section->addTable('myTable');
                                    $table5->addRow(100);
                                    $table5->addCell(2000)->addText('S. No.', $left_10,array('align'=>'left'));
                                    $table5->addCell(8000)->addText('IP', $left_10, array('align'=>'left'));
                                    $table5->addCell(6000)->addText('MAC', $left_10, array('align'=>'left'));
                                    $section->addTextBreak(1);



                                        $j = 1;
                                        $jcount = sizeof($each['ip']);
                                        for($i=0; $i<$jcount; $i++){
                                        // foreach($each['plugin_name'] as $reporthost){
                                        
                                            $table5->addRow(100);
                                            $table5->addCell(2000)->addText($j.' ', $left_10_wb);
                                            $table5->addCell(8000)->addText($each['ip'][$i], $left_10_wb);
                                            $table5->addCell(6000)->addText($each['mac'][$i], $left_10_wb);
                                            $j = $j+1;
                                            
                                        }    


                                        $section->addTextBreak(1);
                                        $section->addTextBreak(1);
                                        $counter = $counter + 1;

                                }


                        }                                            



                    //------------------------- Table 3 - 3 Selected -------------------------------------- //

                        elseif(in_array("Plugin Name", $report_items) && in_array("Description", $report_items) && in_array("Remediation", $report_items)){



                            //------------------- PHP WORD Table 3 --------------------------------------//

                                $section->addTextBreak(1);
                                $section->addTextBreak(1);
                                $section->addText('TABLE 3: Vulnerability detail with description, remedy(fix), occurrences',array('name' => 'Arial', 'size' => 10, 'color'=>'FB0009', 'bold'=>true, 'lineHeight'=>-15));

                                $section->addTextBreak(1, array('lineHeight'=>-15));
                                $section->addText('All coming from the scan fields', array('name' => 'Arial', 'size' => 9, 'color'=>'050002', 'lineHeight'=>-15));
                                $section->addTextBreak(1);
                                $section->addTextBreak(1);


                                $counter = 1;

                                foreach($new_array as $each){

                                    $section->addText($counter.'. '.htmlspecialchars($each['plugin_name']),array('name' => 'Arial', 'size' => 12, 'color'=>'050002', 'bold'=>true) );
                                    $section->addTextBreak(1);


                                    $table3 = $section->addTable('myTable');
                                    $table3->addRow(100);
                                    $table3->addCell(3000, $firstRowStyle)->addText('Description', array('color'=>'050002', 'bold'=>true, 'size' => 11, 'bgColor' => 'a8a8a8'));
                                    $table3->addCell(13000)->addText($each['description'], array('color'=>'050002', 'size' => 10));



                                    $table3->addRow(100);
                                    $table3->addCell(3000, $firstRowStyle)->addText('Remediation', array('color'=>'050002', 'bold'=>true, 'size' => 11, 'bgColor' => 'a8a8a8'));
                                    $table3->addCell(13000)->addText($each['solution'], array('color'=>'050002', 'size' => 10));
                                






                                        $section->addTextBreak(1);
                                        $section->addTextBreak(1);
                                        $counter = $counter + 1;

                                }


                        }

                        elseif(in_array("Plugin Name", $report_items) && in_array("Description", $report_items) &&  in_array("IP Address 3", $report_items) ){



                            //------------------- PHP WORD Table 3 --------------------------------------//

                                $section->addTextBreak(1);
                                $section->addTextBreak(1);
                                $section->addText('TABLE 3: Vulnerability detail with description, remedy(fix), occurrences',array('name' => 'Arial', 'size' => 10, 'color'=>'FB0009', 'bold'=>true, 'lineHeight'=>-15));

                                $section->addTextBreak(1, array('lineHeight'=>-15));
                                $section->addText('All coming from the scan fields', array('name' => 'Arial', 'size' => 9, 'color'=>'050002', 'lineHeight'=>-15));
                                $section->addTextBreak(1);
                                $section->addTextBreak(1);


                                $counter = 1;

                                foreach($new_array as $each){

                                    $section->addText($counter.'. '.htmlspecialchars($each['plugin_name']),array('name' => 'Arial', 'size' => 12, 'color'=>'050002', 'bold'=>true) );
                                    $section->addTextBreak(1);


                                    $table3 = $section->addTable('myTable');
                                    $table3->addRow(100);
                                    $table3->addCell(3000, $firstRowStyle)->addText('Description', array('color'=>'050002', 'bold'=>true, 'size' => 11, 'bgColor' => 'a8a8a8'));
                                    $table3->addCell(13000)->addText($each['description'], array('color'=>'050002', 'size' => 10));




                                    $section->addTextBreak(1);
                                    $section->addText('Following is the list of assets with this vulnerability:',array('name' => 'Arial', 'size' => 10, 'color'=>'050002') );
                                    $section->addTextBreak(1);

                                    $table5 = $section->addTable('myTable');
                                    $table5->addRow(100);
                                    $table5->addCell(2000)->addText('S. No.', $left_10,array('align'=>'left'));
                                    $table5->addCell(8000)->addText('IP', $left_10, array('align'=>'left'));
                                    $section->addTextBreak(1);



                                        $j = 1;
                                        $jcount = sizeof($each['ip']);
                                        for($i=0; $i<$jcount; $i++){
                                        // foreach($each['plugin_name'] as $reporthost){
                                        
                                            $table5->addRow(100);
                                            $table5->addCell(2000)->addText($j.' ', $left_10_wb);
                                            $table5->addCell(8000)->addText($each['ip'][$i], $left_10_wb);
                                            $j = $j+1;
                                            
                                        }    


                                        $section->addTextBreak(1);
                                        $section->addTextBreak(1);
                                        $counter = $counter + 1;

                                }


                        }  

                        elseif(in_array("Plugin Name", $report_items) && in_array("Description", $report_items) &&  in_array("MAC Address 3", $report_items)){



                            //------------------- PHP WORD Table 3 --------------------------------------//

                                $section->addTextBreak(1);
                                $section->addTextBreak(1);
                                $section->addText('TABLE 3: Vulnerability detail with description, remedy(fix), occurrences',array('name' => 'Arial', 'size' => 10, 'color'=>'FB0009', 'bold'=>true, 'lineHeight'=>-15));

                                $section->addTextBreak(1, array('lineHeight'=>-15));
                                $section->addText('All coming from the scan fields', array('name' => 'Arial', 'size' => 9, 'color'=>'050002', 'lineHeight'=>-15));
                                $section->addTextBreak(1);
                                $section->addTextBreak(1);


                                $counter = 1;

                                foreach($new_array as $each){

                                    $section->addText($counter.'. '.htmlspecialchars($each['plugin_name']),array('name' => 'Arial', 'size' => 12, 'color'=>'050002', 'bold'=>true) );
                                    $section->addTextBreak(1);


                                    $table3 = $section->addTable('myTable');
                                    $table3->addRow(100);
                                    $table3->addCell(3000, $firstRowStyle)->addText('Description', array('color'=>'050002', 'bold'=>true, 'size' => 11, 'bgColor' => 'a8a8a8'));
                                    $table3->addCell(13000)->addText($each['description'], array('color'=>'050002', 'size' => 10));









                                    $section->addTextBreak(1);
                                    $section->addText('Following is the list of assets with this vulnerability:',array('name' => 'Arial', 'size' => 10, 'color'=>'050002') );
                                    $section->addTextBreak(1);

                                    $table5 = $section->addTable('myTable');
                                    $table5->addRow(100);
                                    $table5->addCell(2000)->addText('S. No.', $left_10,array('align'=>'left'));
                                    $table5->addCell(6000)->addText('MAC', $left_10, array('align'=>'left'));
                                    $section->addTextBreak(1);



                                        $j = 1;
                                        $jcount = sizeof($each['ip']);
                                        for($i=0; $i<$jcount; $i++){
                                        // foreach($each['plugin_name'] as $reporthost){
                                        
                                            $table5->addRow(100);
                                            $table5->addCell(2000)->addText($j.' ', $left_10_wb);
                                            $table5->addCell(6000)->addText($each['mac'][$i], $left_10_wb);
                                            $j = $j+1;
                                            
                                        }    


                                        $section->addTextBreak(1);
                                        $section->addTextBreak(1);
                                        $counter = $counter + 1;

                                }


                        } 

                        elseif(in_array("Plugin Name", $report_items) && in_array("Remediation", $report_items) &&  in_array("IP Address 3", $report_items) ){



                            //------------------- PHP WORD Table 3 --------------------------------------//

                                $section->addTextBreak(1);
                                $section->addTextBreak(1);
                                $section->addText('TABLE 3: Vulnerability detail with description, remedy(fix), occurrences',array('name' => 'Arial', 'size' => 10, 'color'=>'FB0009', 'bold'=>true, 'lineHeight'=>-15));

                                $section->addTextBreak(1, array('lineHeight'=>-15));
                                $section->addText('All coming from the scan fields', array('name' => 'Arial', 'size' => 9, 'color'=>'050002', 'lineHeight'=>-15));
                                $section->addTextBreak(1);
                                $section->addTextBreak(1);


                                $counter = 1;

                                foreach($new_array as $each){

                                    $section->addText($counter.'. '.htmlspecialchars($each['plugin_name']),array('name' => 'Arial', 'size' => 12, 'color'=>'050002', 'bold'=>true) );
                                    $section->addTextBreak(1);


                                    $table3 = $section->addTable('myTable');




                                    $table3->addRow(100);
                                    $table3->addCell(3000, $firstRowStyle)->addText('Remediation', array('color'=>'050002', 'bold'=>true, 'size' => 11, 'bgColor' => 'a8a8a8'));
                                    $table3->addCell(13000)->addText($each['solution'], array('color'=>'050002', 'size' => 10));
                                







                                    $section->addTextBreak(1);
                                    $section->addText('Following is the list of assets with this vulnerability:',array('name' => 'Arial', 'size' => 10, 'color'=>'050002') );
                                    $section->addTextBreak(1);

                                    $table5 = $section->addTable('myTable');
                                    $table5->addRow(100);
                                    $table5->addCell(2000)->addText('S. No.', $left_10,array('align'=>'left'));
                                    $table5->addCell(8000)->addText('IP', $left_10, array('align'=>'left'));
                                    $section->addTextBreak(1);



                                        $j = 1;
                                        $jcount = sizeof($each['ip']);
                                        for($i=0; $i<$jcount; $i++){
                                        // foreach($each['plugin_name'] as $reporthost){
                                        
                                            $table5->addRow(100);
                                            $table5->addCell(2000)->addText($j.' ', $left_10_wb);
                                            $table5->addCell(8000)->addText($each['ip'][$i], $left_10_wb);
                                            $j = $j+1;
                                            
                                        }    


                                        $section->addTextBreak(1);
                                        $section->addTextBreak(1);
                                        $counter = $counter + 1;

                                }


                        }    

                        elseif(in_array("Plugin Name", $report_items) && in_array("Remediation", $report_items) &&  in_array("MAC Address 3", $report_items)){



                            //------------------- PHP WORD Table 3 --------------------------------------//

                                $section->addTextBreak(1);
                                $section->addTextBreak(1);
                                $section->addText('TABLE 3: Vulnerability detail with description, remedy(fix), occurrences',array('name' => 'Arial', 'size' => 10, 'color'=>'FB0009', 'bold'=>true, 'lineHeight'=>-15));

                                $section->addTextBreak(1, array('lineHeight'=>-15));
                                $section->addText('All coming from the scan fields', array('name' => 'Arial', 'size' => 9, 'color'=>'050002', 'lineHeight'=>-15));
                                $section->addTextBreak(1);
                                $section->addTextBreak(1);


                                $counter = 1;

                                foreach($new_array as $each){

                                    $section->addText($counter.'. '.htmlspecialchars($each['plugin_name']),array('name' => 'Arial', 'size' => 12, 'color'=>'050002', 'bold'=>true) );
                                    $section->addTextBreak(1);


                                    $table3 = $section->addTable('myTable');



                                    $table3->addRow(100);
                                    $table3->addCell(3000, $firstRowStyle)->addText('Remediation', array('color'=>'050002', 'bold'=>true, 'size' => 11, 'bgColor' => 'a8a8a8'));
                                    $table3->addCell(13000)->addText($each['solution'], array('color'=>'050002', 'size' => 10));
                                







                                    $section->addTextBreak(1);
                                    $section->addText('Following is the list of assets with this vulnerability:',array('name' => 'Arial', 'size' => 10, 'color'=>'050002') );
                                    $section->addTextBreak(1);

                                    $table5 = $section->addTable('myTable');
                                    $table5->addRow(100);
                                    $table5->addCell(2000)->addText('S. No.', $left_10,array('align'=>'left'));
                                    $table5->addCell(6000)->addText('MAC', $left_10, array('align'=>'left'));
                                    $section->addTextBreak(1);



                                        $j = 1;
                                        $jcount = sizeof($each['ip']);
                                        for($i=0; $i<$jcount; $i++){
                                        // foreach($each['plugin_name'] as $reporthost){
                                        
                                            $table5->addRow(100);
                                            $table5->addCell(2000)->addText($j.' ', $left_10_wb);
                                            $table5->addCell(6000)->addText($each['mac'][$i], $left_10_wb);
                                            $j = $j+1;
                                            
                                        }    


                                        $section->addTextBreak(1);
                                        $section->addTextBreak(1);
                                        $counter = $counter + 1;

                                }


                        } 

                        elseif(in_array("Plugin Name", $report_items) &&  in_array("IP Address 3", $report_items) &&  in_array("MAC Address 3", $report_items)){



                            //------------------- PHP WORD Table 3 --------------------------------------//

                                $section->addTextBreak(1);
                                $section->addTextBreak(1);
                                $section->addText('TABLE 3: Vulnerability detail with description, remedy(fix), occurrences',array('name' => 'Arial', 'size' => 10, 'color'=>'FB0009', 'bold'=>true, 'lineHeight'=>-15));

                                $section->addTextBreak(1, array('lineHeight'=>-15));
                                $section->addText('All coming from the scan fields', array('name' => 'Arial', 'size' => 9, 'color'=>'050002', 'lineHeight'=>-15));
                                $section->addTextBreak(1);
                                $section->addTextBreak(1);


                                $counter = 1;

                                foreach($new_array as $each){

                                    $section->addText($counter.'. '.htmlspecialchars($each['plugin_name']),array('name' => 'Arial', 'size' => 12, 'color'=>'050002', 'bold'=>true) );
                                    $section->addTextBreak(1);





                                    $section->addTextBreak(1);
                                    $section->addText('Following is the list of assets with this vulnerability:',array('name' => 'Arial', 'size' => 10, 'color'=>'050002') );
                                    $section->addTextBreak(1);

                                    $table5 = $section->addTable('myTable');
                                    $table5->addRow(100);
                                    $table5->addCell(2000)->addText('S. No.', $left_10,array('align'=>'left'));
                                    $table5->addCell(8000)->addText('IP', $left_10, array('align'=>'left'));
                                    $table5->addCell(6000)->addText('MAC', $left_10, array('align'=>'left'));
                                    $section->addTextBreak(1);



                                        $j = 1;
                                        $jcount = sizeof($each['ip']);
                                        for($i=0; $i<$jcount; $i++){
                                        // foreach($each['plugin_name'] as $reporthost){
                                        
                                            $table5->addRow(100);
                                            $table5->addCell(2000)->addText($j.' ', $left_10_wb);
                                            $table5->addCell(8000)->addText($each['ip'][$i], $left_10_wb);
                                            $table5->addCell(6000)->addText($each['mac'][$i], $left_10_wb);
                                            $j = $j+1;
                                            
                                        }    


                                        $section->addTextBreak(1);
                                        $section->addTextBreak(1);
                                        $counter = $counter + 1;

                                }


                        }                                                                



                    //------------------------- Table 3 - 2 Selected -------------------------------------- //

                        elseif(in_array("Plugin Name", $report_items) && in_array("Description", $report_items)){



                            //------------------- PHP WORD Table 3 --------------------------------------//

                                $section->addTextBreak(1);
                                $section->addTextBreak(1);
                                $section->addText('TABLE 3: Vulnerability detail with description, remedy(fix), occurrences',array('name' => 'Arial', 'size' => 10, 'color'=>'FB0009', 'bold'=>true, 'lineHeight'=>-15));

                                $section->addTextBreak(1, array('lineHeight'=>-15));
                                $section->addText('All coming from the scan fields', array('name' => 'Arial', 'size' => 9, 'color'=>'050002', 'lineHeight'=>-15));
                                $section->addTextBreak(1);
                                $section->addTextBreak(1);


                                $counter = 1;

                                foreach($new_array as $each){

                                    $section->addText($counter.'. '.htmlspecialchars($each['plugin_name']),array('name' => 'Arial', 'size' => 12, 'color'=>'050002', 'bold'=>true) );
                                    $section->addTextBreak(1);


                                    $table3 = $section->addTable('myTable');
                                    $table3->addRow(100);
                                    $table3->addCell(3000, $firstRowStyle)->addText('Description', array('color'=>'050002', 'bold'=>true, 'size' => 11, 'bgColor' => 'a8a8a8'));
                                    $table3->addCell(13000)->addText($each['description'], array('color'=>'050002', 'size' => 10));



                                        $section->addTextBreak(1);
                                        $section->addTextBreak(1);
                                        $counter = $counter + 1;

                                }


                        }

                        elseif(in_array("Plugin Name", $report_items) && in_array("Remediation", $report_items)){



                            //------------------- PHP WORD Table 3 --------------------------------------//

                                $section->addTextBreak(1);
                                $section->addTextBreak(1);
                                $section->addText('TABLE 3: Vulnerability detail with description, remedy(fix), occurrences',array('name' => 'Arial', 'size' => 10, 'color'=>'FB0009', 'bold'=>true, 'lineHeight'=>-15));

                                $section->addTextBreak(1, array('lineHeight'=>-15));
                                $section->addText('All coming from the scan fields', array('name' => 'Arial', 'size' => 9, 'color'=>'050002', 'lineHeight'=>-15));
                                $section->addTextBreak(1);
                                $section->addTextBreak(1);


                                $counter = 1;

                                foreach($new_array as $each){

                                    $section->addText($counter.'. '.htmlspecialchars($each['plugin_name']),array('name' => 'Arial', 'size' => 12, 'color'=>'050002', 'bold'=>true) );
                                    $section->addTextBreak(1);


                                    $table3 = $section->addTable('myTable');


                                    $table3->addRow(100);
                                    $table3->addCell(3000, $firstRowStyle)->addText('Remediation', array('color'=>'050002', 'bold'=>true, 'size' => 11, 'bgColor' => 'a8a8a8'));
                                    $table3->addCell(13000)->addText($each['solution'], array('color'=>'050002', 'size' => 10));
                                



                                        $section->addTextBreak(1);
                                        $section->addTextBreak(1);
                                        $counter = $counter + 1;

                                }


                        }  

                        
                        elseif(in_array("Plugin Name", $report_items) && in_array("IP Address 3",$report_items)){


                            //------------------- PHP WORD Table 3 --------------------------------------//

                                $section->addTextBreak(1);
                                $section->addTextBreak(1);
                                $section->addText('TABLE 3: Vulnerability detail with description, remedy(fix), occurrences',array('name' => 'Arial', 'size' => 10, 'color'=>'FB0009', 'bold'=>true, 'lineHeight'=>-15));

                                $section->addTextBreak(1, array('lineHeight'=>-15));
                                $section->addText('All coming from the scan fields', array('name' => 'Arial', 'size' => 9, 'color'=>'050002', 'lineHeight'=>-15));
                                $section->addTextBreak(1);
                                $section->addTextBreak(1);


                                $counter = 1;

                                foreach($new_array as $each){

                                    $section->addText($counter.'. '.htmlspecialchars($each['plugin_name']),array('name' => 'Arial', 'size' => 12, 'color'=>'050002', 'bold'=>true) );
                                    $section->addTextBreak(1);



                                    $section->addTextBreak(1);
                                    $section->addText('Following is the list of assets with this vulnerability:',array('name' => 'Arial', 'size' => 10, 'color'=>'050002') );
                                    $section->addTextBreak(1);

                                    $table5 = $section->addTable('myTable');
                                    $table5->addRow(100);
                                    $table5->addCell(2000)->addText('S. No.', $left_10,array('align'=>'left'));
                                    $table5->addCell(8000)->addText('IP', $left_10, array('align'=>'left'));
                                    $section->addTextBreak(1);



                                        $j = 1;
                                        $jcount = sizeof($each['ip']);
                                        for($i=0; $i<$jcount; $i++){
                                        // foreach($each['plugin_name'] as $reporthost){
                                        
                                            $table5->addRow(100);
                                            $table5->addCell(2000)->addText($j.' ', $left_10_wb);
                                            $table5->addCell(8000)->addText($each['ip'][$i], $left_10_wb);
                                            $j = $j+1;
                                            
                                        }    


                                        $section->addTextBreak(1);
                                        $section->addTextBreak(1);
                                        $counter = $counter + 1;

                                }


                        } 

                        elseif(in_array("Plugin Name",$report_items) && in_array("MAC Address 3",$report_items)){



                            //------------------- PHP WORD Table 3 --------------------------------------//

                                $section->addTextBreak(1);
                                $section->addTextBreak(1);
                                $section->addText('TABLE 3: Vulnerability detail with description, remedy(fix), occurrences',array('name' => 'Arial', 'size' => 10, 'color'=>'FB0009', 'bold'=>true, 'lineHeight'=>-15));

                                $section->addTextBreak(1, array('lineHeight'=>-15));
                                $section->addText('All coming from the scan fields', array('name' => 'Arial', 'size' => 9, 'color'=>'050002', 'lineHeight'=>-15));
                                $section->addTextBreak(1);
                                $section->addTextBreak(1);


                                $counter = 1;

                                foreach($new_array as $each){

                                    $section->addText($counter.'. '.htmlspecialchars($each['plugin_name']),array('name' => 'Arial', 'size' => 12, 'color'=>'050002', 'bold'=>true) );
                                    $section->addTextBreak(1);



                                    $section->addTextBreak(1);
                                    $section->addText('Following is the list of assets with this vulnerability:',array('name' => 'Arial', 'size' => 10, 'color'=>'050002') );
                                    $section->addTextBreak(1);

                                    $table5 = $section->addTable('myTable');
                                    $table5->addRow(100);
                                    $table5->addCell(2000)->addText('S. No.', $left_10,array('align'=>'left'));
                                    $table5->addCell(6000)->addText('MAC', $left_10, array('align'=>'left'));
                                    $section->addTextBreak(1);



                                        $j = 1;
                                        $jcount = sizeof($each['ip']);
                                        for($i=0; $i<$jcount; $i++){
                                        // foreach($each['plugin_name'] as $reporthost){
                                        
                                            $table5->addRow(100);
                                            $table5->addCell(2000)->addText($j.' ', $left_10_wb);
                                            $table5->addCell(6000)->addText($each['mac'][$i], $left_10_wb);
                                            $j = $j+1;
                                            
                                        }    


                                        $section->addTextBreak(1);
                                        $section->addTextBreak(1);
                                        $counter = $counter + 1;

                                }


                        }                                            



                    //------------------------- Table 3 - 1 Selected -------------------------------------- //

                        elseif(in_array("Plugin Name", $report_items)){



                            //------------------- PHP WORD Table 3 --------------------------------------//

                                $section->addTextBreak(1);
                                $section->addTextBreak(1);
                                $section->addText('TABLE 3: Vulnerability detail with description, remedy(fix), occurrences',array('name' => 'Arial', 'size' => 10, 'color'=>'FB0009', 'bold'=>true, 'lineHeight'=>-15));

                                $section->addTextBreak(1, array('lineHeight'=>-15));
                                $section->addText('All coming from the scan fields', array('name' => 'Arial', 'size' => 9, 'color'=>'050002', 'lineHeight'=>-15));
                                $section->addTextBreak(1);
                                $section->addTextBreak(1);


                                $counter = 1;

                                foreach($new_array as $each){

                                    $section->addText($counter.'. '.htmlspecialchars($each['plugin_name']),array('name' => 'Arial', 'size' => 12, 'color'=>'050002', 'bold'=>true) );
                                    $section->addTextBreak(1);



                                        $section->addTextBreak(1);
                                        $section->addTextBreak(1);
                                        $counter = $counter + 1;

                                }


                        }

                }        

                // ------------PHPWORD Writer - Output Word Document ----------------------//

                    $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
                    $file = 'HelloWorld.docx';
                    $objWriter->save($file);


                    // \PhpOffice\PhpWord\Settings::setPdfRendererPath('tcpdf_min');
                    // \PhpOffice\PhpWord\Settings::setPdfRendererName('TCPDF');
                    // $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord , 'PDF');
                    // $xmlWriter->save('helloworld.pdf');
                    
                    header('Content-Description: File Transfer');
                    header('Content-Type: application/octet-stream');
                    header('Content-Disposition: attachment; filename='.$file);
                    header('Content-Transfer-Encoding: binary');
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                    header('Pragma: public');
                    header('Content-Length: ' . filesize($file));
                    flush();
                    readfile($file);
                    unlink($file); // deletes the temporary file
                    exit;

            }


        }

        elseif($request->pdf){
            
            // $this->updated_pdf($request->project_id); die();

            $project_id = $request->project_id[sizeof($request->project_id)-1];
            $reportfiles = Reportfile::where('project_id', $project_id)->get();
            $reportfile_ids = $reportfiles->lists('id');


            if(Reporthost::whereIn('reportfile_id', $reportfile_ids)->count() == 0){

                return \Redirect::route('file_upload')->with('message','Please upload a nessus report file');

            }
            else{

                // ---------------- Fpdf Addpage ---------------------- //              
                  
                    Fpdf::AddPage();            
                    Fpdf::SetFont("Times","B","18");
                    Fpdf::SetTitle('Report CSAS.');
                    Fpdf::Cell(0, 10, "Report CSAS.",0,1,"L");
                    // Fpdf::Cell(0, 10, "",0,1,"C");
                    Fpdf::ln();




                if(in_array("table1", $report_table)){        
                        
                    
                    // ------------------ Table 1 Data Fetch ----------------------//

                        $Reporthost = new Reporthost();
                        $most_vulnerable_assets = $Reporthost->get_most_vulnerable_assets($project_id);
                        $most_vulnerable_assets = $this->array_orderby($most_vulnerable_assets, 'count', SORT_DESC);
                   
                    
                    //------------------------- Table 1 - 4 Selected -------------------------------------- //

                        if(in_array("IP Address 1", $report_items) && in_array("MAC Address 1", $report_items) && in_array("Asset Type", $report_items) &&  in_array("Vulnerability Count", $report_items))
                        {


                            // ------------------- FPDF Table 1 --------------------------------------//

                            
                                // Colors, line width and bold font
                                Fpdf::SetFillColor(168,168,168);
                                Fpdf::SetTextColor(251,0,9);
                                // Fpdf::SetDrawColor(128,0,0);
                                Fpdf::SetLineWidth(.3);
                                Fpdf::SetFont("Times","","14");
                                // Fpdf::SetFont('','B');

                                Fpdf::Cell(0,10,'TABLE 1: List of most vulnerable assets in the client\'s network',0,0);
                                Fpdf::ln();
                                Fpdf::SetTextColor(0);
                                Fpdf::SetFont("Times","B","11");
                                Fpdf::Cell(12,11, 'ID',1,0,'',true);
                                Fpdf::Cell(30,11, 'IP',1,0,'',true);
                                Fpdf::Cell(33,11, 'MAC',1,0,'',true);
                                Fpdf::Cell(29,11, 'System Type',1,0,'',true);
                                Fpdf::Cell(78,11, 'Opeating System',1,0,'',true);
                                Fpdf::Cell(12,11, 'Count',1,1,'C',true); 

                                Fpdf::SetFont("Times","","10");
                                foreach($most_vulnerable_assets as $each){

                                    Fpdf::Cell(12,10,$each['id'],1,0,'L');
                                    Fpdf::Cell(30,10,$each['ip'],1,0,'L');
                                    Fpdf::Cell(33,10,$each['mac'],1,0,'C');
                                    Fpdf::Cell(29,10,$each['system_type'],1,0,'L');
                                    Fpdf::Cell(78,10,$each['operating_system'],1,0, 'L');
                                    Fpdf::Cell(12,10,$each['count'],1,1,'C');

                                }

                                Fpdf::ln();
                                Fpdf::ln();

                        }


                    //------------------------- Table 1 - 3 Selected -------------------------------------- //

                        elseif(in_array("IP Address 1", $report_items) && in_array("MAC Address 1", $report_items) && in_array("Asset Type", $report_items) )
                        {
                            
                            // ------------------- FPDF Table 1 --------------------------------------//


                            
                                // Colors, line width and bold font
                                Fpdf::SetFillColor(168,168,168);
                                Fpdf::SetTextColor(251,0,9);
                                // Fpdf::SetDrawColor(128,0,0);
                                Fpdf::SetLineWidth(.3);
                                Fpdf::SetFont("Times","","14");
                                // Fpdf::SetFont('','B');

                                Fpdf::Cell(0,10,'TABLE 1: List of most vulnerable assets in the client\'s network',0,0);
                                Fpdf::ln();
                                Fpdf::SetTextColor(0);
                                Fpdf::SetFont("Times","B","11");
                                Fpdf::Cell(12,11, 'ID',1,0,'',true);
                                Fpdf::Cell(30,11, 'IP',1,0,'',true);
                                Fpdf::Cell(33,11, 'MAC',1,0,'',true);
                                Fpdf::Cell(29,11, 'System Type',1,0,'',true);
                                Fpdf::Cell(78,11, 'Opeating System',1,1,'',true);

                                Fpdf::SetFont("Times","","10");
                                foreach($most_vulnerable_assets as $each){

                                    Fpdf::Cell(12,10,$each['id'],1,0,'L');
                                    Fpdf::Cell(30,10,$each['ip'],1,0,'L');
                                    Fpdf::Cell(33,10,$each['mac'],1,0,'C');
                                    Fpdf::Cell(29,10,$each['system_type'],1,0,'L');
                                    Fpdf::Cell(29,10,$each['operating_system'],1,1,'L');

                                }

                                Fpdf::ln();
                                Fpdf::ln();


                        }

                        elseif(in_array("IP Address 1", $report_items) && in_array("MAC Address 1", $report_items) && in_array("Vulnerability Count", $report_items) )
                        {


                            // ------------------- FPDF Table 1 --------------------------------------//

                                // Colors, line width and bold font
                                Fpdf::SetFillColor(168,168,168);
                                Fpdf::SetTextColor(251,0,9);
                                // Fpdf::SetDrawColor(128,0,0);
                                Fpdf::SetLineWidth(.3);
                                Fpdf::SetFont("Times","","14");
                                // Fpdf::SetFont('','B');

                                Fpdf::Cell(0,10,'TABLE 1: List of most vulnerable assets in the client\'s network',0,0);
                                Fpdf::ln();
                                Fpdf::SetTextColor(0);
                                Fpdf::SetFont("Times","B","11");
                                Fpdf::Cell(12,11, 'ID',1,0,'',true);
                                Fpdf::Cell(30,11, 'IP',1,0,'',true);
                                Fpdf::Cell(33,11, 'MAC',1,0,'',true);
                                Fpdf::Cell(12,11, 'Count',1,1,'C',true); 

                                Fpdf::SetFont("Times","","10");
                                foreach($most_vulnerable_assets as $each){

                                    Fpdf::Cell(12,10,$each['id'],1,0,'L');
                                    Fpdf::Cell(30,10,$each['ip'],1,0,'L');
                                    Fpdf::Cell(33,10,$each['mac'],1,0,'C');
                                    Fpdf::Cell(12,10,$each['count'],1,1,'C');

                                }

                                Fpdf::ln();
                                Fpdf::ln();

                        
                        }

                        elseif(in_array("IP Address 1", $report_items) && in_array("Asset Type", $report_items) && in_array("Vulnerability Count", $report_items) )
                        {
                            

                            // ------------------- FPDF Table 1 --------------------------------------//


                                // Colors, line width and bold font
                                Fpdf::SetFillColor(168,168,168);
                                Fpdf::SetTextColor(251,0,9);
                                // Fpdf::SetDrawColor(128,0,0);
                                Fpdf::SetLineWidth(.3);
                                Fpdf::SetFont("Times","","14");
                                // Fpdf::SetFont('','B');

                                Fpdf::Cell(0,10,'TABLE 1: List of most vulnerable assets in the client\'s network',0,0);
                                Fpdf::ln();
                                Fpdf::SetTextColor(0);
                                Fpdf::SetFont("Times","B","11");
                                Fpdf::Cell(12,11, 'ID',1,0,'',true);
                                Fpdf::Cell(30,11, 'IP',1,0,'',true);
                                Fpdf::Cell(29,11, 'System Type',1,0,'',true);
                                Fpdf::Cell(78,11, 'Opeating System',1,0,'',true);
                                Fpdf::Cell(12,11, 'Count',1,1,'C',true); 

                                Fpdf::SetFont("Times","","10");
                                foreach($most_vulnerable_assets as $each){

                                    Fpdf::Cell(12,10,$each['id'],1,0,'L');
                                    Fpdf::Cell(30,10,$each['ip'],1,0,'L');
                                    Fpdf::Cell(29,10,$each['system_type'],1,0,'L');
                                    Fpdf::Cell(78,10,$each['operating_system'],1,0, 'L');
                                    Fpdf::Cell(12,10,$each['count'],1,1,'C');

                                }

                                Fpdf::ln();
                                Fpdf::ln();
                            
                        
                        }


                    //------------------------- Table 1 - 2 Selected -------------------------------------- //

                        elseif(in_array("IP Address 1", $report_items) && in_array("MAC Address 1", $report_items) )
                        {
                            

                            // ------------------- FPDF Table 1 --------------------------------------//


                                // Colors, line width and bold font
                                Fpdf::SetFillColor(168,168,168);
                                Fpdf::SetTextColor(251,0,9);
                                // Fpdf::SetDrawColor(128,0,0);
                                Fpdf::SetLineWidth(.3);
                                Fpdf::SetFont("Times","","14");
                                // Fpdf::SetFont('','B');

                                Fpdf::Cell(0,10,'TABLE 1: List of most vulnerable assets in the client\'s network',0,0);
                                Fpdf::ln();
                                Fpdf::SetTextColor(0);
                                Fpdf::SetFont("Times","B","11");
                                Fpdf::Cell(12,11, 'ID',1,0,'',true);
                                Fpdf::Cell(30,11, 'IP',1,0,'',true);
                                Fpdf::Cell(33,11, 'MAC',1,1,'',true);

                                Fpdf::SetFont("Times","","10");
                                foreach($most_vulnerable_assets as $each){

                                    Fpdf::Cell(12,10,$each['id'],1,0,'L');
                                    Fpdf::Cell(30,10,$each['ip'],1,0,'L');
                                    Fpdf::Cell(33,10,$each['mac'],1,1,'C');

                                }

                                Fpdf::ln();
                                Fpdf::ln();

                        
                        }

                        elseif(in_array("IP Address 1", $report_items) && in_array("Asset Type", $report_items) )
                        {
                            

                            // ------------------- FPDF Table 1 --------------------------------------//


                                // Colors, line width and bold font
                                Fpdf::SetFillColor(168,168,168);
                                Fpdf::SetTextColor(251,0,9);
                                // Fpdf::SetDrawColor(128,0,0);
                                Fpdf::SetLineWidth(.3);
                                Fpdf::SetFont("Times","","14");
                                // Fpdf::SetFont('','B');

                                Fpdf::Cell(0,10,'TABLE 1: List of most vulnerable assets in the client\'s network',0,0);
                                Fpdf::ln();
                                Fpdf::SetTextColor(0);
                                Fpdf::SetFont("Times","B","11");
                                Fpdf::Cell(12,11, 'ID',1,0,'',true);
                                Fpdf::Cell(30,11, 'IP',1,0,'',true);
                                Fpdf::Cell(29,11, 'System Type',1,0,'',true);
                                Fpdf::Cell(78,11, 'Opeating System',1,1,'',true);

                                Fpdf::SetFont("Times","","10");
                                foreach($most_vulnerable_assets as $each){

                                    Fpdf::Cell(12,10,$each['id'],1,0,'L');
                                    Fpdf::Cell(30,10,$each['ip'],1,0,'L');
                                    Fpdf::Cell(29,10,$each['system_type'],1,0,'L');
                                    Fpdf::Cell(78,10,$each['operating_system'],1,1, 'L');

                                }

                                Fpdf::ln();
                                Fpdf::ln();
                  
                        
                        }

                        elseif(in_array("IP Address 1", $report_items) && in_array("Vulnerability Count", $report_items))
                        {
                            

                            // ------------------- FPDF Table 1 --------------------------------------//


                                // Colors, line width and bold font
                                Fpdf::SetFillColor(168,168,168);
                                Fpdf::SetTextColor(251,0,9);
                                // Fpdf::SetDrawColor(128,0,0);
                                Fpdf::SetLineWidth(.3);
                                Fpdf::SetFont("Times","","14");
                                // Fpdf::SetFont('','B');

                                Fpdf::Cell(0,10,'TABLE 1: List of most vulnerable assets in the client\'s network',0,0);
                                Fpdf::ln();
                                Fpdf::SetTextColor(0);
                                Fpdf::SetFont("Times","B","11");
                                Fpdf::Cell(12,11, 'ID',1,0,'',true);
                                Fpdf::Cell(30,11, 'IP',1,0,'',true);
                                Fpdf::Cell(12,11, 'Count',1,1,'C',true); 

                                Fpdf::SetFont("Times","","10");
                                foreach($most_vulnerable_assets as $each){

                                    Fpdf::Cell(12,10,$each['id'],1,0,'L');
                                    Fpdf::Cell(30,10,$each['ip'],1,0,'L');
                                    Fpdf::Cell(12,10,$each['count'],1,1,'C');

                                }

                                Fpdf::ln();
                                Fpdf::ln();
           
                        
                        }     


                    //------------------------- Table 1 - 1 Selected -------------------------------------- //

                        elseif(in_array("IP Address 1", $report_items))
                        {
                            

                            // ------------------- FPDF Table 1 --------------------------------------//


                                // Colors, line width and bold font
                                Fpdf::SetFillColor(168,168,168);
                                Fpdf::SetTextColor(251,0,9);
                                // Fpdf::SetDrawColor(128,0,0);
                                Fpdf::SetLineWidth(.3);
                                Fpdf::SetFont("Times","","14");
                                // Fpdf::SetFont('','B');

                                Fpdf::Cell(0,10,'TABLE 1: List of most vulnerable assets in the client\'s network',0,0);
                                Fpdf::ln();
                                Fpdf::SetTextColor(0);
                                Fpdf::SetFont("Times","B","11");
                                Fpdf::Cell(12,11, 'ID',1,0,'',true);
                                Fpdf::Cell(30,11, 'IP',1,1,'',true);

                                Fpdf::SetFont("Times","","10");
                                foreach($most_vulnerable_assets as $each){

                                    Fpdf::Cell(12,10,$each['id'],1,0,'L');
                                    Fpdf::Cell(30,10,$each['ip'],1,1,'L');

                                }

                                Fpdf::ln();
                                Fpdf::ln();
                
                        
                        }                   

                
                }        
                
                if(in_array("table2", $report_table)){      

                    Fpdf::SetFillColor(168,168,168);

                    // ------------------ Table 2 Data Fetch ----------------------//

                        $Reportitem = new Reportitem();
                        $vulnerabilities = $Reportitem->get_vulnerabilities($project_id);
                        

                    //------------------------- Table 2 - 2 Selected -------------------------------------- //

                        if(in_array("Exploit Category", $report_items) && in_array("Infected Assets Count", $report_items)){

                            //------------------- FPDF Table 2 --------------------------------------//

                                Fpdf::SetTextColor(251,0,9);
                                Fpdf::SetFont("Times","","14");

                                Fpdf::Cell(0,10,'TABLE 2: Top 10 Vulnerability names with its total count / occurrence',0,0);
                                Fpdf::ln();

                                Fpdf::SetTextColor(0);
                                Fpdf::SetFont("Times","B","11");

                                Fpdf::Cell(12,10, 'ID' , 1, 0, '', true);
                                Fpdf::Cell(150,10, 'Vulnerability Name',1,0,'',true);
                                Fpdf::Cell(20,10, 'Count',1,1,'C',true);


                                Fpdf::SetFont("Times","","10");

                                foreach($vulnerabilities as $key => $each){

                                        Fpdf::Cell(12,10, $key+'1', 1);
                                        Fpdf::Cell(150,10, $each->plugin_name ,1);
                                        Fpdf::Cell(20,10, $each->total, 1, 1, 'C');
                                        
                                }

                                Fpdf::ln();

                        }


                    //------------------------- Table 2 - 1 Selected -------------------------------------- //

                        elseif(in_array("Exploit Category", $report_items)){

                            //------------------- FPDF Table 2 --------------------------------------//

                                Fpdf::SetTextColor(251,0,9);
                                Fpdf::SetFont("Times","","14");

                                Fpdf::Cell(0,10,'TABLE 2: Top 10 Vulnerability names with its total count / occurrence',0,0);
                                Fpdf::ln();

                                Fpdf::SetTextColor(0);
                                Fpdf::SetFont("Times","B","11");

                                Fpdf::Cell(12,10, 'ID' , 1, 0, '', true);
                                Fpdf::Cell(150,10, 'Vulnerability Name',1,1,'',true);


                                Fpdf::SetFont("Times","","10");

                                foreach($vulnerabilities as $key => $each){

                                        Fpdf::Cell(12,10, $key+'1', 1);
                                        Fpdf::Cell(150,10, $each->plugin_name ,1,1);
                                        
                                }

                                Fpdf::ln();

                        }                        

                } 

                if(in_array("table3", $report_table)){   

                    Fpdf::SetFillColor(168,168,168);

                    // ------------------ Table 3 Data Fetch -----------------//

                        $Reporthost = new Reporthost();
                        $Reportitem = new Reportitem();

                        // Fetcching all records in reportitems table
                        $vulnerability_details = $Reportitem->read_reportitems_having_unique_reporthost_id($project_id);


                        // Creating new arrays to store data
                        $new_array = array();

                        foreach($vulnerability_details as $detail){

                            // Fetching ip and mac from reporthosts table by reporthost_id from reportitems
                            $reporthosts = $Reporthost->ip_mac_by_reporthost_id($detail->reporthost_id);
     

                            if(!array_key_exists($detail->plugin_name, $new_array)){

                                $new_array[$detail->plugin_name]['plugin_name'] = $detail->plugin_name;
                                $new_array[$detail->plugin_name]['description'] = $detail->description;
                                $new_array[$detail->plugin_name]['solution']    = $detail->solution;
                                
                                foreach($reporthosts as $reporthost){

                                    $new_array[$detail->plugin_name]['ip']      = [$reporthost->host_ip];
                                    $new_array[$detail->plugin_name]['mac']     = [$reporthost->mac];
                                  
                                }
                                    
                            }
                            elseif(array_key_exists($detail->plugin_name, $new_array)){

                                foreach($reporthosts as $reporthost){

                                    array_push($new_array[$detail->plugin_name]['ip'], $reporthost->host_ip);
                                    array_push($new_array[$detail->plugin_name]['mac'], $reporthost->mac);
                                    
             
                                }                        

                            }

                        }    


                    //------------------------- Table 3 - 5 Selected -------------------------------------- //


                        if(in_array("Plugin Name", $report_items) && in_array("Description", $report_items) && in_array("Remediation", $report_items) &&  in_array("IP Address 3", $report_items) &&  in_array("MAC Address 3", $report_items)){

                            //------------------- FPDF Table 3 --------------------------------------//


                                Fpdf::SetTextColor(251,0,9);
                                Fpdf::SetFont("Times","","14");

                                Fpdf::Cell(0,10,'TABLE 3: Vulnerability detail with description, remedy(fix), occurrences',0,0);
                                Fpdf::ln();

                                Fpdf::SetTextColor(0);
                                
                                $k=1;
                                foreach($new_array as $each){

                                    
                                    Fpdf::SetFont("Times","B","12");
                                    Fpdf::SetTextColor(251,0,9);
                                    Fpdf::MultiCell(0, 10, $k.'. '.$each['plugin_name'] , 0, 1);

                                    Fpdf::SetTextColor(0);
                                    Fpdf::SetFont('Times','B',"11");
                                    Fpdf::Cell(4,10, '',0,0,'');                    
                                    Fpdf::Cell(40,10, 'Description',0,0,'');                    
                                    Fpdf::SetFont("Times","I","11");
                                    Fpdf::MultiCell(0,10, $each['description'], 0, 1);

                                    Fpdf::SetFont('Times','B',"11");
                                    Fpdf::Cell(4,10, '',0,0,'');    
                                    Fpdf::Cell(40,10, 'Remediation',0,0,'L');   
                                    Fpdf::SetFont("Times","I","11");
                                    Fpdf::MultiCell(0,10, $each['solution'], 0, 1);
                                    // Fpdf::ln();

                                    Fpdf::SetFont('Times','B',"12");
                                    // Fpdf::SetTextColor(251,0,9);
                                    Fpdf::Cell(30,10, 'Following is the list of assets with this vulnerability', 0, 1);

                                    Fpdf::SetTextColor(0);
                                    Fpdf::SetFont("Times","B","11");
                                    Fpdf::Cell(20,10, 'S. No.',1,0,'',true);
                                    Fpdf::Cell(70,10, '   IP',1,0,'',true);
                                    Fpdf::Cell(100,10, '   MAC', 1, 1,'', true);

                                    Fpdf::SetFont("Times","","10");
                                    $jcount = sizeof($each['ip']);
                                    for($i=0; $i<$jcount; $i++){

                                            Fpdf::Cell(20,10, $i+'1', 1);
                                            Fpdf::Cell(70,10, $each['ip'][$i] ,1);
                                            Fpdf::Cell(100,10, $each['mac'][$i], 1, 1);
                                            
                                    }
                                    
                                    Fpdf::ln();
                                    Fpdf::ln();
                                    Fpdf::SetAutoPageBreak(true,2);
                                    $k= $k+1;

                                }


                        }


                    //------------------------- Table 3 - 4 Selected -------------------------------------- //

                        elseif(in_array("Plugin Name", $report_items) && in_array("Description", $report_items) && in_array("Remediation", $report_items) &&  in_array("IP Address 3", $report_items)){



                            //------------------- FPDF Table 3 --------------------------------------//


                                Fpdf::SetTextColor(251,0,9);
                                Fpdf::SetFont("Times","","14");

                                Fpdf::Cell(0,10,'TABLE 3: Vulnerability detail with description, remedy(fix), occurrences',0,0);
                                Fpdf::ln();

                                Fpdf::SetTextColor(0);
                                
                                $k=1;
                                foreach($new_array as $each){

                                    
                                    Fpdf::SetFont("Times","B","12");
                                    Fpdf::SetTextColor(251,0,9);
                                    Fpdf::MultiCell(0, 10, $k.'. '.$each['plugin_name'] , 0, 1);

                                    Fpdf::SetTextColor(0);
                                    Fpdf::SetFont('Times','B',"11");
                                    Fpdf::Cell(4,10, '',0,0,'');                    
                                    Fpdf::Cell(40,10, 'Description',0,0,'');                    
                                    Fpdf::SetFont("Times","I","11");
                                    Fpdf::MultiCell(0,10, $each['description'], 0, 1);

                                    Fpdf::SetFont('Times','B',"11");
                                    Fpdf::Cell(4,10, '',0,0,'');    
                                    Fpdf::Cell(40,10, 'Remediation',0,0,'L');   
                                    Fpdf::SetFont("Times","I","11");
                                    Fpdf::MultiCell(0,10, $each['solution'], 0, 1);
                                    // Fpdf::ln();

                                    Fpdf::SetFont('Times','B',"12");
                                    // Fpdf::SetTextColor(251,0,9);
                                    Fpdf::Cell(30,10, 'Following is the list of assets with this vulnerability', 0, 1);

                                    Fpdf::SetTextColor(0);
                                    Fpdf::SetFont("Times","B","11");
                                    Fpdf::Cell(20,10, 'S. No.',1,0,'',true);
                                    Fpdf::Cell(70,10, '   IP',1,1,'',true);

                                    Fpdf::SetFont("Times","","10");
                                    $jcount = sizeof($each['ip']);
                                    for($i=0; $i<$jcount; $i++){

                                            Fpdf::Cell(20,10, $i+'1', 1);
                                            Fpdf::Cell(70,10, $each['ip'][$i] ,1,1);
                                            
                                    }
                                    
                                    Fpdf::ln();
                                    Fpdf::ln();
                                    Fpdf::SetAutoPageBreak(true,2);
                                    $k= $k+1;

                                }



                        }

                        elseif(in_array("Plugin Name", $report_items) && in_array("Description", $report_items) && in_array("Remediation", $report_items) &&  in_array("MAC Address 3", $report_items)){



                            //------------------- FPDF Table 3 --------------------------------------//


                                Fpdf::SetTextColor(251,0,9);
                                Fpdf::SetFont("Times","","14");

                                Fpdf::Cell(0,10,'TABLE 3: Vulnerability detail with description, remedy(fix), occurrences',0,0);
                                Fpdf::ln();

                                Fpdf::SetTextColor(0);
                                
                                $k=1;
                                foreach($new_array as $each){

                                    
                                    Fpdf::SetFont("Times","B","12");
                                    Fpdf::SetTextColor(251,0,9);
                                    Fpdf::MultiCell(0, 10, $k.'. '.$each['plugin_name'] , 0, 1);

                                    Fpdf::SetTextColor(0);
                                    Fpdf::SetFont('Times','B',"11");
                                    Fpdf::Cell(4,10, '',0,0,'');                    
                                    Fpdf::Cell(40,10, 'Description',0,0,'');                    
                                    Fpdf::SetFont("Times","I","11");
                                    Fpdf::MultiCell(0,10, $each['description'], 0, 1);

                                    Fpdf::SetFont('Times','B',"11");
                                    Fpdf::Cell(4,10, '',0,0,'');    
                                    Fpdf::Cell(40,10, 'Remediation',0,0,'L');   
                                    Fpdf::SetFont("Times","I","11");
                                    Fpdf::MultiCell(0,10, $each['solution'], 0, 1);
                                    // Fpdf::ln();

                                    Fpdf::SetFont('Times','B',"12");
                                    // Fpdf::SetTextColor(251,0,9);
                                    Fpdf::Cell(30,10, 'Following is the list of assets with this vulnerability', 0, 1);

                                    Fpdf::SetTextColor(0);
                                    Fpdf::SetFont("Times","B","11");
                                    Fpdf::Cell(20,10, 'S. No.',1,0,'',true);
                                    Fpdf::Cell(100,10, '   MAC', 1, 1,'', true);

                                    Fpdf::SetFont("Times","","10");
                                    $jcount = sizeof($each['ip']);
                                    for($i=0; $i<$jcount; $i++){

                                            Fpdf::Cell(20,10, $i+'1', 1);
                                            Fpdf::Cell(100,10, $each['mac'][$i], 1, 1);
                                            
                                    }
                                    
                                    Fpdf::ln();
                                    Fpdf::ln();
                                    Fpdf::SetAutoPageBreak(true,2);
                                    $k= $k+1;

                                }



                        }  

                        elseif(in_array("Plugin Name", $report_items) && in_array("Description", $report_items) &&  in_array("IP Address 3", $report_items) &&  in_array("MAC Address 3", $report_items)){



                            //------------------- FPDF Table 3 --------------------------------------//


                                Fpdf::SetTextColor(251,0,9);
                                Fpdf::SetFont("Times","","14");

                                Fpdf::Cell(0,10,'TABLE 3: Vulnerability detail with description, remedy(fix), occurrences',0,0);
                                Fpdf::ln();

                                Fpdf::SetTextColor(0);
                                
                                $k=1;
                                foreach($new_array as $each){

                                    
                                    Fpdf::SetFont("Times","B","12");
                                    Fpdf::SetTextColor(251,0,9);
                                    Fpdf::MultiCell(0, 10, $k.'. '.$each['plugin_name'] , 0, 1);

                                    Fpdf::SetTextColor(0);
                                    Fpdf::SetFont('Times','B',"11");
                                    Fpdf::Cell(4,10, '',0,0,'');                    
                                    Fpdf::Cell(40,10, 'Description',0,0,'');                    
                                    Fpdf::SetFont("Times","I","11");
                                    Fpdf::MultiCell(0,10, $each['description'], 0, 1);


                                    Fpdf::SetFont('Times','B',"12");
                                    // Fpdf::SetTextColor(251,0,9);
                                    Fpdf::Cell(30,10, 'Following is the list of assets with this vulnerability', 0, 1);

                                    Fpdf::SetTextColor(0);
                                    Fpdf::SetFont("Times","B","11");
                                    Fpdf::Cell(20,10, 'S. No.',1,0,'',true);
                                    Fpdf::Cell(70,10, '   IP',1,0,'',true);
                                    Fpdf::Cell(100,10, '   MAC', 1, 1,'', true);

                                    Fpdf::SetFont("Times","","10");
                                    $jcount = sizeof($each['ip']);
                                    for($i=0; $i<$jcount; $i++){

                                            Fpdf::Cell(20,10, $i+'1', 1);
                                            Fpdf::Cell(70,10, $each['ip'][$i] ,1);
                                            Fpdf::Cell(100,10, $each['mac'][$i], 1, 1);
                                            
                                    }
                                    
                                    Fpdf::ln();
                                    Fpdf::ln();
                                    Fpdf::SetAutoPageBreak(true,2);
                                    $k= $k+1;

                                }


                        } 

                        elseif(in_array("Plugin Name", $report_items) && in_array("Remediation", $report_items) &&  in_array("IP Address 3", $report_items) &&  in_array("MAC Address 3", $report_items)){



                            //------------------- FPDF Table 3 --------------------------------------//


                                Fpdf::SetTextColor(251,0,9);
                                Fpdf::SetFont("Times","","14");

                                Fpdf::Cell(0,10,'TABLE 3: Vulnerability detail with description, remedy(fix), occurrences',0,0);
                                Fpdf::ln();

                                Fpdf::SetTextColor(0);
                                
                                $k=1;
                                foreach($new_array as $each){

                                    
                                    Fpdf::SetFont("Times","B","12");
                                    Fpdf::SetTextColor(251,0,9);
                                    Fpdf::MultiCell(0, 10, $k.'. '.$each['plugin_name'] , 0, 1);

                                    Fpdf::SetTextColor(0);
                                    Fpdf::SetFont('Times','B',"11");
                                    Fpdf::Cell(4,10, '',0,0,'');    
                                    Fpdf::Cell(40,10, 'Remediation',0,0,'L');   
                                    Fpdf::SetFont("Times","I","11");
                                    Fpdf::MultiCell(0,10, $each['solution'], 0, 1);
                                    // Fpdf::ln();

                                    Fpdf::SetFont('Times','B',"12");
                                    // Fpdf::SetTextColor(251,0,9);
                                    Fpdf::Cell(30,10, 'Following is the list of assets with this vulnerability', 0, 1);

                                    Fpdf::SetTextColor(0);
                                    Fpdf::SetFont("Times","B","11");
                                    Fpdf::Cell(20,10, 'S. No.',1,0,'',true);
                                    Fpdf::Cell(70,10, '   IP',1,0,'',true);
                                    Fpdf::Cell(100,10, '   MAC', 1, 1,'', true);

                                    Fpdf::SetFont("Times","","10");
                                    $jcount = sizeof($each['ip']);
                                    for($i=0; $i<$jcount; $i++){

                                            Fpdf::Cell(20,10, $i+'1', 1);
                                            Fpdf::Cell(70,10, $each['ip'][$i] ,1);
                                            Fpdf::Cell(100,10, $each['mac'][$i], 1, 1);
                                            
                                    }
                                    
                                    Fpdf::ln();
                                    Fpdf::ln();
                                    Fpdf::SetAutoPageBreak(true,2);
                                    $k= $k+1;

                                }



                        }                                            



                    //------------------------- Table 3 - 3 Selected -------------------------------------- //

                        elseif(in_array("Plugin Name", $report_items) && in_array("Description", $report_items) && in_array("Remediation", $report_items)){



                            //------------------- FPDF Table 3 --------------------------------------//


                                Fpdf::SetTextColor(251,0,9);
                                Fpdf::SetFont("Times","","14");

                                Fpdf::Cell(0,10,'TABLE 3: Vulnerability detail with description, remedy(fix), occurrences',0,0);
                                Fpdf::ln();

                                Fpdf::SetTextColor(0);
                                
                                $k=1;
                                foreach($new_array as $each){

                                    
                                    Fpdf::SetFont("Times","B","12");
                                    Fpdf::SetTextColor(251,0,9);
                                    Fpdf::MultiCell(0, 10, $k.'. '.$each['plugin_name'] , 0, 1);

                                    Fpdf::SetTextColor(0);
                                    Fpdf::SetFont('Times','B',"11");
                                    Fpdf::Cell(4,10, '',0,0,'');                    
                                    Fpdf::Cell(40,10, 'Description',0,0,'');                    
                                    Fpdf::SetFont("Times","I","11");
                                    Fpdf::MultiCell(0,10, $each['description'], 0, 1);

                                    Fpdf::SetTextColor(0);
                                    Fpdf::SetFont('Times','B',"11");
                                    Fpdf::Cell(4,10, '',0,0,'');    
                                    Fpdf::Cell(40,10, 'Remediation',0,0,'L');   
                                    Fpdf::SetFont("Times","I","11");
                                    Fpdf::MultiCell(0,10, $each['solution'], 0, 1);
                                    // Fpdf::ln();

                                    Fpdf::ln();
                                    Fpdf::ln();
                                    Fpdf::SetAutoPageBreak(true,2);
                                    $k= $k+1;

                                }



                        }

                        elseif(in_array("Plugin Name", $report_items) && in_array("Description", $report_items) &&  in_array("IP Address 3", $report_items) ){



                            //------------------- FPDF Table 3 --------------------------------------//


                                Fpdf::SetTextColor(251,0,9);
                                Fpdf::SetFont("Times","","14");

                                Fpdf::Cell(0,10,'TABLE 3: Vulnerability detail with description, remedy(fix), occurrences',0,0);
                                Fpdf::ln();

                                Fpdf::SetTextColor(0);
                                
                                $k=1;
                                foreach($new_array as $each){

                                    
                                    Fpdf::SetFont("Times","B","12");
                                    Fpdf::SetTextColor(251,0,9);
                                    Fpdf::MultiCell(0, 10, $k.'. '.$each['plugin_name'] , 0, 1);

                                    Fpdf::SetTextColor(0);
                                    Fpdf::SetFont('Times','B',"11");
                                    Fpdf::Cell(4,10, '',0,0,'');                    
                                    Fpdf::Cell(40,10, 'Description',0,0,'');                    
                                    Fpdf::SetFont("Times","I","11");
                                    Fpdf::MultiCell(0,10, $each['description'], 0, 1);



                                    Fpdf::SetFont('Times','B',"12");
                                    // Fpdf::SetTextColor(251,0,9);
                                    Fpdf::Cell(30,10, 'Following is the list of assets with this vulnerability', 0, 1);

                                    Fpdf::SetTextColor(0);
                                    Fpdf::SetFont("Times","B","11");
                                    Fpdf::Cell(20,10, 'S. No.',1,0,'',true);
                                    Fpdf::Cell(70,10, '   IP',1,1,'',true);

                                    Fpdf::SetFont("Times","","10");
                                    $jcount = sizeof($each['ip']);
                                    for($i=0; $i<$jcount; $i++){

                                            Fpdf::Cell(20,10, $i+'1', 1);
                                            Fpdf::Cell(70,10, $each['ip'][$i] ,1,1);
                                            
                                    }
                                    
                                    Fpdf::ln();
                                    Fpdf::ln();
                                    Fpdf::SetAutoPageBreak(true,2);
                                    $k= $k+1;

                                }




                        }  

                        elseif(in_array("Plugin Name", $report_items) && in_array("Description", $report_items) &&  in_array("MAC Address 3", $report_items)){



                            //------------------- FPDF Table 3 --------------------------------------//

                                Fpdf::SetTextColor(251,0,9);
                                Fpdf::SetFont("Times","","14");

                                Fpdf::Cell(0,10,'TABLE 3: Vulnerability detail with description, remedy(fix), occurrences',0,0);
                                Fpdf::ln();

                                Fpdf::SetTextColor(0);
                                
                                $k=1;
                                foreach($new_array as $each){

                                    
                                    Fpdf::SetFont("Times","B","12");
                                    Fpdf::SetTextColor(251,0,9);
                                    Fpdf::MultiCell(0, 10, $k.'. '.$each['plugin_name'] , 0, 1);
                                    Fpdf::SetTextColor(0);

                                    Fpdf::SetTextColor(0);
                                    Fpdf::SetFont('Times','B',"11");
                                    Fpdf::Cell(4,10, '',0,0,'');                    
                                    Fpdf::Cell(40,10, 'Description',0,0,'');                    
                                    Fpdf::SetFont("Times","I","11");
                                    Fpdf::MultiCell(0,10, $each['description'], 0, 1);



                                    Fpdf::SetFont('Times','B',"12");
                                    // Fpdf::SetTextColor(251,0,9);
                                    Fpdf::Cell(30,10, 'Following is the list of assets with this vulnerability', 0, 1);

                                    Fpdf::SetTextColor(0);
                                    Fpdf::SetFont("Times","B","11");
                                    Fpdf::Cell(20,10, 'S. No.',1,0,'',true);
                                    Fpdf::Cell(100,10, '   MAC', 1, 1,'', true);

                                    Fpdf::SetFont("Times","","10");
                                    $jcount = sizeof($each['ip']);
                                    for($i=0; $i<$jcount; $i++){

                                            Fpdf::Cell(20,10, $i+'1', 1);
                                            Fpdf::Cell(100,10, $each['mac'][$i], 1, 1);
                                            
                                    }
                                    
                                    Fpdf::ln();
                                    Fpdf::ln();
                                    Fpdf::SetAutoPageBreak(true,2);
                                    $k= $k+1;

                                }




                        } 

                        elseif(in_array("Plugin Name", $report_items) && in_array("Remediation", $report_items) &&  in_array("IP Address 3", $report_items) ){



                            //------------------- FPDF Table 3 --------------------------------------//

                                Fpdf::SetTextColor(251,0,9);
                                Fpdf::SetFont("Times","","14");

                                Fpdf::Cell(0,10,'TABLE 3: Vulnerability detail with description, remedy(fix), occurrences',0,0);
                                Fpdf::ln();

                                Fpdf::SetTextColor(0);
                                
                                $k=1;
                                foreach($new_array as $each){

                                    
                                    Fpdf::SetFont("Times","B","12");
                                    Fpdf::SetTextColor(251,0,9);
                                    Fpdf::MultiCell(0, 10, $k.'. '.$each['plugin_name'] , 0, 1);
                                    Fpdf::SetTextColor(0);

                                    Fpdf::SetTextColor(0);
                                    Fpdf::SetFont('Times','B',"11");
                                    Fpdf::Cell(4,10, '',0,0,'');    
                                    Fpdf::Cell(40,10, 'Remediation',0,0,'L');   
                                    Fpdf::SetFont("Times","I","11");
                                    Fpdf::MultiCell(0,10, $each['solution'], 0, 1);
                                    // Fpdf::ln();

                                    Fpdf::SetFont('Times','B',"12");
                                    // Fpdf::SetTextColor(251,0,9);
                                    Fpdf::Cell(30,10, 'Following is the list of assets with this vulnerability', 0, 1);

                                    Fpdf::SetTextColor(0);
                                    Fpdf::SetFont("Times","B","11");
                                    Fpdf::Cell(20,10, 'S. No.',1,0,'',true);
                                    Fpdf::Cell(70,10, '   IP',1,1,'',true);

                                    Fpdf::SetFont("Times","","10");
                                    $jcount = sizeof($each['ip']);
                                    for($i=0; $i<$jcount; $i++){

                                            Fpdf::Cell(20,10, $i+'1', 1);
                                            Fpdf::Cell(70,10, $each['ip'][$i] ,1,1);
                                            
                                    }
                                    
                                    Fpdf::ln();
                                    Fpdf::ln();
                                    Fpdf::SetAutoPageBreak(true,2);
                                    $k= $k+1;

                                }



                        }    

                        elseif(in_array("Plugin Name", $report_items) && in_array("Remediation", $report_items) &&  in_array("MAC Address 3", $report_items)){



                            //------------------- FPDF Table 3 --------------------------------------//

                                Fpdf::SetTextColor(251,0,9);
                                Fpdf::SetFont("Times","","14");

                                Fpdf::Cell(0,10,'TABLE 3: Vulnerability detail with description, remedy(fix), occurrences',0,0);
                                Fpdf::ln();

                                Fpdf::SetTextColor(0);
                                
                                $k=1;
                                foreach($new_array as $each){

                                    
                                    Fpdf::SetFont("Times","B","12");
                                    Fpdf::SetTextColor(251,0,9);
                                    Fpdf::MultiCell(0, 10, $k.'. '.$each['plugin_name'] , 0, 1);
                                    Fpdf::SetTextColor(0);


                                    Fpdf::SetTextColor(0);
                                    Fpdf::SetFont('Times','B',"11");
                                    Fpdf::Cell(4,10, '',0,0,'');    
                                    Fpdf::Cell(40,10, 'Remediation',0,0,'L');   
                                    Fpdf::SetFont("Times","I","11");
                                    Fpdf::MultiCell(0,10, $each['solution'], 0, 1);
                                    // Fpdf::ln();

                                    Fpdf::SetFont('Times','B',"12");
                                    // Fpdf::SetTextColor(251,0,9);
                                    Fpdf::Cell(30,10, 'Following is the list of assets with this vulnerability', 0, 1);

                                    Fpdf::SetTextColor(0);
                                    Fpdf::SetFont("Times","B","11");
                                    Fpdf::Cell(20,10, 'S. No.',1,0,'',true);
                                    Fpdf::Cell(100,10, '   MAC', 1, 1,'', true);

                                    Fpdf::SetFont("Times","","10");
                                    $jcount = sizeof($each['ip']);
                                    for($i=0; $i<$jcount; $i++){

                                            Fpdf::Cell(20,10, $i+'1', 1);
                                            Fpdf::Cell(100,10, $each['mac'][$i], 1, 1);
                                            
                                    }
                                    
                                    Fpdf::ln();
                                    Fpdf::ln();
                                    Fpdf::SetAutoPageBreak(true,2);
                                    $k= $k+1;

                                }



                        } 

                        elseif(in_array("Plugin Name", $report_items) &&  in_array("IP Address 3", $report_items) &&  in_array("MAC Address 3", $report_items)){



                            //------------------- FPDF Table 3 --------------------------------------//

                                Fpdf::SetTextColor(251,0,9);
                                Fpdf::SetFont("Times","","14");

                                Fpdf::Cell(0,10,'TABLE 3: Vulnerability detail with description, remedy(fix), occurrences',0,0);
                                Fpdf::ln();

                                Fpdf::SetTextColor(0);
                                
                                $k=1;
                                foreach($new_array as $each){

                                    
                                    Fpdf::SetFont("Times","B","12");
                                    Fpdf::SetTextColor(251,0,9);
                                    Fpdf::MultiCell(0, 10, $k.'. '.$each['plugin_name'] , 0, 1);
                                    Fpdf::SetTextColor(0);


                                    Fpdf::SetFont('Times','B',"12");
                                    // Fpdf::SetTextColor(251,0,9);
                                    Fpdf::Cell(30,10, 'Following is the list of assets with this vulnerability', 0, 1);

                                    Fpdf::SetTextColor(0);
                                    Fpdf::SetFont("Times","B","11");
                                    Fpdf::Cell(20,10, 'S. No.',1,0,'',true);
                                    Fpdf::Cell(70,10, '   IP',1,0,'',true);
                                    Fpdf::Cell(100,10, '   MAC', 1, 1,'', true);

                                    Fpdf::SetFont("Times","","10");
                                    $jcount = sizeof($each['ip']);
                                    for($i=0; $i<$jcount; $i++){

                                            Fpdf::Cell(20,10, $i+'1', 1);
                                            Fpdf::Cell(70,10, $each['ip'][$i] ,1);
                                            Fpdf::Cell(100,10, $each['mac'][$i], 1, 1);
                                            
                                    }
                                    
                                    Fpdf::ln();
                                    Fpdf::ln();
                                    Fpdf::SetAutoPageBreak(true,2);
                                    $k= $k+1;

                                }

                        }                                                                



                    //------------------------- Table 3 - 2 Selected -------------------------------------- //

                        elseif(in_array("Plugin Name", $report_items) && in_array("Description", $report_items)){



                            //------------------- FPDF Table 3 --------------------------------------//

                                Fpdf::SetTextColor(251,0,9);
                                Fpdf::SetFont("Times","","14");

                                Fpdf::Cell(0,10,'TABLE 3: Vulnerability detail with description, remedy(fix), occurrences',0,0);
                                Fpdf::ln();

                                Fpdf::SetTextColor(0);
                                
                                $k=1;
                                foreach($new_array as $each){

                                    
                                    Fpdf::SetFont("Times","B","12");
                                    Fpdf::SetTextColor(251,0,9);
                                    Fpdf::MultiCell(0, 10, $k.'. '.$each['plugin_name'] , 0, 1);
                                    Fpdf::SetTextColor(0);

                                    Fpdf::SetTextColor(0);
                                    Fpdf::SetFont('Times','B',"11");
                                    Fpdf::Cell(4,10, '',0,0,'');                    
                                    Fpdf::Cell(40,10, 'Description',0,0,'');                    
                                    Fpdf::SetFont("Times","I","11");
                                    Fpdf::MultiCell(0,10, $each['description'], 0, 1);


                                    
                                    Fpdf::ln();
                                    Fpdf::ln();
                                    Fpdf::SetAutoPageBreak(true,2);
                                    $k= $k+1;

                                }

                        }

                        elseif(in_array("Plugin Name", $report_items) && in_array("Remediation", $report_items)){



                            //------------------- FPDF Table 3 --------------------------------------//

                                Fpdf::SetTextColor(251,0,9);
                                Fpdf::SetFont("Times","","14");

                                Fpdf::Cell(0,10,'TABLE 3: Vulnerability detail with description, remedy(fix), occurrences',0,0);
                                Fpdf::ln();

                                Fpdf::SetTextColor(0);
                                
                                $k=1;
                                foreach($new_array as $each){

                                    
                                    Fpdf::SetFont("Times","B","12");
                                    Fpdf::SetTextColor(251,0,9);
                                    Fpdf::MultiCell(0, 10, $k.'. '.$each['plugin_name'] , 0, 1);
                                    Fpdf::SetTextColor(0);


                                    Fpdf::SetTextColor(0);
                                    Fpdf::SetFont('Times','B',"11");
                                    Fpdf::Cell(4,10, '',0,0,'');    
                                    Fpdf::Cell(40,10, 'Remediation',0,0,'L');   
                                    Fpdf::SetFont("Times","I","11");
                                    Fpdf::MultiCell(0,10, $each['solution'], 0, 1);
                                    // Fpdf::ln();

                                  
                                    Fpdf::ln();
                                    Fpdf::ln();
                                    Fpdf::SetAutoPageBreak(true,2);
                                    $k= $k+1;

                                }


                        }  

                        
                        elseif(in_array("Plugin Name", $report_items) && in_array("IP Address 3",$report_items)){


                            //------------------- FPDF Table 3 --------------------------------------//

                                Fpdf::SetTextColor(251,0,9);
                                Fpdf::SetFont("Times","","14");

                                Fpdf::Cell(0,10,'TABLE 3: Vulnerability detail with description, remedy(fix), occurrences',0,0);
                                Fpdf::ln();

                                Fpdf::SetTextColor(0);
                                
                                $k=1;
                                foreach($new_array as $each){

                                    
                                    Fpdf::SetFont("Times","B","12");
                                    Fpdf::SetTextColor(251,0,9);
                                    Fpdf::MultiCell(0, 10, $k.'. '.$each['plugin_name'] , 0, 1);
                                    Fpdf::SetTextColor(0);


                                    Fpdf::SetFont('Times','B',"12");
                                    // Fpdf::SetTextColor(251,0,9);
                                    Fpdf::Cell(30,10, 'Following is the list of assets with this vulnerability', 0, 1);

                                    Fpdf::SetTextColor(0);
                                    Fpdf::SetFont("Times","B","11");
                                    Fpdf::Cell(20,10, 'S. No.',1,0,'',true);
                                    Fpdf::Cell(70,10, '   IP',1,1,'',true);

                                    Fpdf::SetFont("Times","","10");
                                    $jcount = sizeof($each['ip']);
                                    for($i=0; $i<$jcount; $i++){

                                            Fpdf::Cell(20,10, $i+'1', 1);
                                            Fpdf::Cell(70,10, $each['ip'][$i] ,1,1);
                                            
                                    }
                                    
                                    Fpdf::ln();
                                    Fpdf::ln();
                                    Fpdf::SetAutoPageBreak(true,2);
                                    $k= $k+1;

                                }


                        } 

                        elseif(in_array("Plugin Name",$report_items) && in_array("MAC Address 3",$report_items)){



                            //------------------- FPDF Table 3 --------------------------------------//

                                Fpdf::SetTextColor(251,0,9);
                                Fpdf::SetFont("Times","","14");

                                Fpdf::Cell(0,10,'TABLE 3: Vulnerability detail with description, remedy(fix), occurrences',0,0);
                                Fpdf::ln();

                                Fpdf::SetTextColor(0);
                                
                                $k=1;
                                foreach($new_array as $each){

                                    
                                    Fpdf::SetFont("Times","B","12");
                                    Fpdf::SetTextColor(251,0,9);
                                    Fpdf::MultiCell(0, 10, $k.'. '.$each['plugin_name'] , 0, 1);
                                    Fpdf::SetTextColor(0);


                                    Fpdf::SetFont('Times','B',"12");
                                    // Fpdf::SetTextColor(251,0,9);
                                    Fpdf::Cell(30,10, 'Following is the list of assets with this vulnerability', 0, 1);

                                    Fpdf::SetTextColor(0);
                                    Fpdf::SetFont("Times","B","11");
                                    Fpdf::Cell(20,10, 'S. No.',1,0,'',true);
                                    Fpdf::Cell(100,10, '   MAC', 1, 1,'', true);

                                    Fpdf::SetFont("Times","","10");
                                    $jcount = sizeof($each['ip']);
                                    for($i=0; $i<$jcount; $i++){

                                            Fpdf::Cell(20,10, $i+'1', 1);
                                            Fpdf::Cell(100,10, $each['mac'][$i], 1, 1);
                                            
                                    }
                                    
                                    Fpdf::ln();
                                    Fpdf::ln();
                                    Fpdf::SetAutoPageBreak(true,2);
                                    $k= $k+1;

                                }

                        }                                            



                    //------------------------- Table 3 - 1 Selected -------------------------------------- //

                        elseif(in_array("Plugin Name", $report_items)){



                            //------------------- FPDF Table 3 --------------------------------------//
                                
                                Fpdf::ln();
                                Fpdf::SetTextColor(251,0,9);
                                Fpdf::SetFont("Times","","14");

                                Fpdf::Cell(0,10,'TABLE 3: Vulnerability detail with description, remedy(fix), occurrences',0,0);
                                Fpdf::ln();

                                Fpdf::SetTextColor(0);
                                
                                $k=1;
                                foreach($new_array as $each){

                                    
                                    Fpdf::SetFont("Times","","12");
                                    Fpdf::MultiCell(0, 10, $k.'. '.$each['plugin_name'] , 0, 1);
                                    
                                    
                                    Fpdf::ln();
                                    Fpdf::SetAutoPageBreak(true,2);
                                    $k= $k+1;

                                }

                        }

                }        


                // ---------------- Fpdf Writer ---------------------- //                  

                    Fpdf::Output();
                    exit;



            }


        }

    }









}
