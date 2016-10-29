<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadNessusRequest;

use App\Pluginid;

use App\Reporthost;

use App\Reportitem;

use App\User;

use App\Role;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\File;

use phpoffice\phpword;

use Session;

use Fpdf;


class NessusController extends Controller
{
    public function create_user(){

        // Role::create([
        //     'name' => 'Admin',
        //     ]);
        // Role::create([
        //     'name' => 'Pentester',
        //     ]);
        // Role::create([
        //     'name' => 'Reverse Engineer',
        //     ]);

        User::create([
            'name'      => 'Muhammad',
            'email'     => 'muhammad@yahoo.com',
            'password'  => 'something',
            // 'role_id'   =>  1,
            ]);
        User::create([
            'name'      => 'Faisal',
            'email'     => 'faisal@yahoo.com',
            'password'  => 'something',
            // 'role_id'   =>  2,
            ]);
        User::create([
            'name'      => 'Ishaq',
            'email'     => 'ishaq@yahoo.com',
            'password'  => 'something',
            // 'role_id'   =>  2,
            ]);
        User::create([
            'name'      => 'Mustafa',
            'email'     => 'mustafa@yahoo.com',
            'password'  => 'something',
            // 'role_id'   =>  3,
            ]);

    }

    public function upload(UploadNessusRequest $request){

            $nessus_file_upload = $request->file('nessus_file_upload');
            $nessus_content = File::get($nessus_file_upload);

            $this->save_plugin_id($nessus_content); 

            // echo "<pre>";
            // var_dump($display);
            // echo "</pre>";

            $this->save_reporthosts_and_reportitems($nessus_content); 

            return \Redirect::route('file_upload')->with('message', 'Nessus File Parsed and Stored in Database');

    }

    public function save_plugin_id($nessus_content){


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
    
                        Pluginid::store($plugin_id_array);

                    }
    
                }
    
            }
            

    }

    public function save_reporthosts_and_reportitems($nessus_content){

            $reading = $nessus_content;

            preg_match_all("#<\s*?ReportHost\b[^>]*>(.*?)</ReportHost\b[^>]*>#s", $reading, $reporthosts);
            
            // Loop through each Reporthost (IP)
            foreach($reporthosts[1] as $reporthost){
                    
                $this->parse_data($reporthost);
                
            }


    }

    
    public function parse_data($reporthost){


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
            $lastinsertedid = $ReportHost->store($reporthost_metadata);


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

            



            // return $lastinsertedid;


    }


    public function reports(){

        return view ('reports');

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


    public function updated_word(){


            // ---------------- PHPWord ---------------------- //    
            
                $reading = File::get(public_path('includes/nessus_input_file/faisal_sc.nessus'));
                // \PhpOffice\PhpWord\Autoloader::register();  
                $phpWord = new \PhpOffice\PhpWord\PhpWord();
                $section = $phpWord->createSection();

                $section->addText('CSAS Report.',array('name' => 'Tahoma', 'size' => 18, 'italic'=>true, 'color'=>'006699') );
                $section->addTextBreak(1);




            // ------------------ Table 1 Data Fetch ----------------------//

                $Reporthost = new Reporthost();
                $most_vulnerable_assets = $Reporthost->get_most_vulnerable_assets();

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

            
            // ------------------- PHPWORD Table 1 --------------------------------------//

                $section->addText('TABLE 1: List of most vulnerable assets in the client’s network',array('name' => 'Tahoma', 'size' => 14, 'color'=>'red', 'italic'=>true) );
                $section->addTextBreak(1);
                $table =$section->addTable();
                $table->addRow(900);
                $table->addCell(1000)->addText('Sr.', array('color'=>'006699'));
                $table->addCell(2500)->addText('IP Address', array('color'=>'006699'));
                $table->addCell(3000)->addText('MAC Address', array('color'=>'006699'));
                $table->addCell(3500)->addText('Asset Type*', array('color'=>'006699'));
                $table->addCell(2500)->addText('Count', array('color'=>'006699'));

                $table_1 = $section->addTable();

                $j = 1;
                foreach($most_vulnerable_assets as $host_property){
                    $table_1->addRow(900);
                    $table_1->addCell(1000)->addText($j);
                    $table_1->addCell(2500)->addText($host_property['ip']);
                    $table_1->addCell(3000)->addText($host_property['mac']);
                    $table_1->addCell(3000)->addText($host_property['system_type'].'                                        '.$host_property['operating_system']);
                    $table_1->addCell(2500)->addText('        '.$host_property['count']);

                    $j = $j+1;

                }





            // ------------------ Table 2 Data Fetch ----------------------//

                $Reportitem = new Reportitem();
                $vulnerabilities = $Reportitem->get_vulnerabilities();
                
                // Used when assoc array was returned
                // arsort($vulnerabilities);

                    // echo '<pre>';
                    // var_dump($vulnerabilities);
                    // echo '</pre>';
 

            //------------------- PHP WORD Table 2 --------------------------------------//

                $section->addTextBreak(1);
                $section->addText('TABLE 2: Top 10 Vulnerability names with its total count / occurrence',array('name' => 'Tahoma', 'size' => 14, 'color'=>'red', 'italic'=>true) );
                $section->addTextBreak(1);
                $table2 = $section->addTable();
                $table2->addRow(100);
                $table2->addCell(15000)->addText('Exploit Category', array('color'=>'006699'));
                $table2->addCell(2500)->addText('Infected Assets', array('color'=>'006699'));

                $table_3 = $section->addTable();

                $counter=0;

                foreach($vulnerabilities as $each){
                // foreach($vulnerability as $key => $new){    
                    if($counter<10){
                        $table_3->addRow(100);
                        // $table_3->addCell(15000)->addText(htmlspecialchars($key));
                        // $table_3->addCell(2500)->addText('          '.htmlspecialchars($new));
                        $table_3->addCell(15000)->addText(htmlspecialchars($each->plugin_name));
                        $table_3->addCell(2500)->addText('          '.htmlspecialchars($each->total));
                    }
                    $counter = $counter + 1;
                }    





            // ---------------- Table 3 Data Fetch -----------------//

                $Reporthost = new Reporthost();
                $Reportitem = new Reportitem();

                // Fetcching all records in reportitems table
                $vulnerability_details = $Reportitem->read_reportitems_having_unique_reporthost_id();


                // Creating new arrays to store data
                $new_array = array();
                $ip_mac = array();

                foreach($vulnerability_details as $detail){

                    // Fetching ip and mac from reporthosts table by reporthost_id from reportitems
                    $reporthosts = $Reporthost->ip_mac_by_reporthost_id($detail->reporthost_id);
                   
                    // // Testing total ip and mac received from function above                   
                    // echo '<pre>'; 
                    // foreach($reporthosts as $reporthost){
                    //     // var_dump($reporthosts);
                    //     echo $reporthost->host_ip. '   '. $reporthost->mac;
                    // }
                    // echo '</pre>';
                    // die();

                    if(!array_key_exists($detail->plugin_name, $new_array)){

                        $new_array[$detail->plugin_name]['plugin_name'] = $detail->plugin_name;
                        $new_array[$detail->plugin_name]['description'] = $detail->description;
                        $new_array[$detail->plugin_name]['solution']    = $detail->solution;
                        
                        foreach($reporthosts as $reporthost){

                            $new_array[$detail->plugin_name]['ip']      = [$reporthost->host_ip];
                            $new_array[$detail->plugin_name]['mac']     = [$reporthost->mac];
                          
                            // Storing combination of ip mac in $ip_mac array to check if next data set matches then dont write into array                         
                            // $ip_mac[$detail->plugin_name]               = [$reporthost->ip,$reporthost->mac];

                            // Retrieving ports 
                            // $ports = $Reportitem->get_port_by_plugin_name_and_reporthost_id($detail->plugin_name,$detail->reporthost_id);                            
                            // foreach($ports as $port){
                            //     $new_array[$detail->plugin_name]['port'] = [$port->port];
                            // }
                        }
                            
                    }
                    elseif(array_key_exists($detail->plugin_name, $new_array)){

                        foreach($reporthosts as $reporthost){

                            array_push($new_array[$detail->plugin_name]['ip'], $reporthost->host_ip);
                            array_push($new_array[$detail->plugin_name]['mac'], $reporthost->mac);
                            
                            // Storing combination of ip mac in $ip_mac array to check if next data set matches then dont write into array 
                            // if(!in_array([$detail->ip,$detail->mac], $ip_mac[$detail->plugin_name])){
                            //     array_push($ip_mac[$detail->plugin_name], [$reporthost->host_ip, $reporthost->mac]);
                            // }

                            // Retrieving ports 
                            // $ports = $Reportitem->get_port_by_plugin_name_and_reporthost_id($detail->plugin_name,$detail->reporthost_id);
                            // foreach($ports as $port){
                            //     array_push($new_array[$detail->plugin_name]['port'], $port->port);
                            // }
                        }                        

                    }

                }    

                // // Testing final data inserted in custom structure array - $new_array 
                // echo '<pre>';
                // var_dump($new_array);
                // echo '</pre>';
                // die();


            //------------------- PHP WORD Table 3 --------------------------------------//

                $section->addTextBreak(1);
                $section->addText('TABLE 3: Vulnerability detail with description, remedy(fix), occurrences',array('name' => 'Tahoma', 'size' => 14, 'color'=>'red', 'italic'=>true) );
                $section->addTextBreak(1);
                $section->addTextBreak(1);


                $counter = 1;

                foreach($new_array as $each){

                    $section->addText($counter.'. '.htmlspecialchars($each['plugin_name']),array('name' => 'Tahoma', 'size' => 12, 'color'=>'black', 'bold'=>true) );
                    $section->addTextBreak(1);


                    $table4 = $section->addTable();
                    $table4->addRow(100);
                    $table4->addCell(3000)->addText('           Description', array('color'=>'black', 'bold'=>true));
                    $table4->addCell(13000)->addText($each['description'], array('color'=>'006699'));

                    $table4->addRow(100);
                    $table4->addCell(3000)->addText('           Remediation', array('color'=>'black', 'bold'=>true));
                    $table4->addCell(13000)->addText($each['solution'], array('color'=>'006699'));
                


                    $section->addTextBreak(1);
                    $section->addText('Following is the list of assets with this vulnerability:',array('name' => 'Tahoma', 'size' => 12, 'color'=>'black') );
                    $section->addTextBreak(1);

                    $table5 = $section->addTable();
                    $table5->addRow(100);
                    $table5->addCell(2000)->addText('S. No.', array('color'=>'black', 'italic'=>true, 'bold'=>true));
                    $table5->addCell(8000)->addText('IP', array('color'=>'black', 'italic'=>true, 'bold'=>true));
                    $table5->addCell(6000)->addText('MAC', array('color'=>'black', 'italic'=>true, 'bold'=>true));
                    $section->addTextBreak(1);



                        $j = 1;
                        $jcount = sizeof($each['ip']);
                        for($i=0; $i<$jcount; $i++){
                        // foreach($each['plugin_name'] as $reporthost){
                        
                            $table5->addRow(100);
                            $table5->addCell(2000)->addText($j.' ', array('color'=>'006699'));
                            $table5->addCell(8000)->addText($each['ip'][$i], array('color'=>'006699'));
                            $table5->addCell(6000)->addText($each['mac'][$i], array('color'=>'006699'));
                            $j = $j+1;
                            
                        }    


                        $section->addTextBreak(1);
                        $counter = $counter + 1;

                }



            // ------------PHPWORD Writer - Output Word Document ----------------------//

                $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
                $file = 'HelloWorld.docx';
                $objWriter->save($file);
                
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



    public function updated_pdf(){

            // ---------------- Fpdf Addpage ---------------------- //              
                Fpdf::AddPage();            
                Fpdf::SetFont("Arial","B","14");
                Fpdf::SetTitle('Report CSAS.');
                Fpdf::Cell(0, 10, "Report CSAS.",0,1,"C");
                Fpdf::Cell(0, 10, "",0,1,"C");


            // ----------------- Table 1 Data Fetch ----------------------//

                $Reporthost = new Reporthost();
                $most_vulnerable_assets = $Reporthost->get_most_vulnerable_assets();
                $most_vulnerable_assets = $this->array_orderby($most_vulnerable_assets, 'count', SORT_DESC);

            // ----------------- Table 1 Data Pdf Output -----------------//
            
                Fpdf::Cell(0,10,'TABLE 1: List of most vulnerable assets in the client\'s network',0,1);
                Fpdf::ln();
                Fpdf::SetFont("Arial","I","10");
                Fpdf::Cell(12,10, 'ID',1);
                Fpdf::Cell(30,10, 'IP',1);
                Fpdf::Cell(33,10, 'MAC',1);
                Fpdf::Cell(29,10, 'System Type',1);
                Fpdf::Cell(78,10, 'Opeating System',1);
                Fpdf::Cell(12,10, 'Count',1,1,'C'); 


                foreach($most_vulnerable_assets as $each){

                    Fpdf::Cell(12,10,$each['id'],1,0,'L');
                    Fpdf::Cell(30,10,$each['ip'],1,0,'L');
                    Fpdf::Cell(33,10,$each['mac'],1,0,'C');
                    Fpdf::Cell(29,10,$each['system_type'],1,0,'L');
                    Fpdf::Cell(78,10,$each['operating_system'],1,0,'L');
                    Fpdf::Cell(12,10,$each['count'],1,1,'C');

                }

                Fpdf::Cell(0, 20, "",0,1,"C");


            // ----------------- Table 2 Data Fetch ----------------------//


                $Reportitem = new Reportitem();
                $vulnerabilities = $Reportitem->get_vulnerabilities();

            // ----------------- Table 2 Data Pdf Output -------------------//

                Fpdf::SetFont("Arial","B","14");
                Fpdf::Cell(0,10,'TABLE 2: Top 10 Vulnerability names with its total count / occurrence',0,1);
                Fpdf::ln();
                Fpdf::SetFont("Arial","I","10");
                Fpdf::Cell(12,10, 'ID' , 1);
                Fpdf::Cell(150,10, 'Vulnerability Name',1);
                Fpdf::Cell(20,10, 'Count',1,1,'C');

                foreach($vulnerabilities as $key => $each){

                        Fpdf::Cell(12,10, $key+'1', 1);
                        Fpdf::Cell(150,10, $each->plugin_name ,1);
                        Fpdf::Cell(20,10, $each->total, 1, 1, 'C');
                        
                }



            // ---------------- Table 3 Data Fetch -----------------//

                $Reporthost = new Reporthost();
                $Reportitem = new Reportitem();

                // Fetcching all records in reportitems table
                $vulnerability_details = $Reportitem->read_reportitems_having_unique_reporthost_id();

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

                // // Testing final data inserted in custom structure array - $new_array 
                // echo '<pre>';
                // var_dump($new_array);
                // echo '</pre>';
                // die();



            // ----------------- Table 3 Data Pdf Output -------------------//

                Fpdf::ln();
                Fpdf::SetFont("Arial","B","14");
                Fpdf::Cell(0,10,'TABLE 3: Vulnerability detail with description, remedy(fix), occurrences',0,1);
                Fpdf::ln();
                
                $k=1;
                foreach($new_array as $each){

                    Fpdf::SetFont('Arial','B',"11");
                    Fpdf::Cell(0, 10, $k.'. '.$each['plugin_name'] , 0, 1);

                    Fpdf::Cell(40,10, 'Description',0,0);                    
                    Fpdf::SetFont("Arial","I","10");
                    Fpdf::MultiCell(0,10, $each['description'], 0, 1);
                    Fpdf::SetFont('Arial','B',"11");
                    Fpdf::Cell(40,10, 'Remediation',0,0,'L');   
                    Fpdf::SetFont("Arial","I","10");
                    Fpdf::MultiCell(0,10, $each['solution'], 0, 1);
                    Fpdf::SetFont('Arial','B',"11");
                    Fpdf::Cell(30,10, 'Following is the list of assets with this vulnerability', 0, 1);
                    Fpdf::Cell(0,10, ' ', 0, 1);
                    Fpdf::SetFont("Arial","I","10");
                    Fpdf::Cell(20,10, 'S. No.',1);
                    Fpdf::Cell(70,10, '   IP',1);
                    Fpdf::Cell(100,10, '   MAC', 1, 1);

                    // foreach($each[] as $key => $each){
                    $jcount = sizeof($each['ip']);
                    for($i=0; $i<$jcount; $i++){

                            Fpdf::Cell(20,10, $i+'1', 1);
                            Fpdf::Cell(70,10, $each['ip'][$i] ,1);
                            Fpdf::Cell(100,10, $each['mac'][$i], 1, 1);
                            
                    }
                    
                    Fpdf::ln();
                    Fpdf::ln();
                    Fpdf::SetAutoPageBreak(1,1);
                    $k= $k+1;

                }


            // ---------------- Fpdf Writer ---------------------- //                  

                Fpdf::Output();
                exit;




    }







































    public function word(){

            // ---------------- PHPWord ---------------------- //    
            
                $reading = File::get(public_path('includes/nessus_input_file/faisal_sc.nessus'));
                // \PhpOffice\PhpWord\Autoloader::register();  
                $phpWord = new \PhpOffice\PhpWord\PhpWord();
                $section = $phpWord->createSection();

                $section->addText('NSPR Report.',array('name' => 'Tahoma', 'size' => 18, 'italic'=>true, 'color'=>'006699') );
                $section->addTextBreak(1);


                $xml    = simplexml_load_file(public_path('includes/nessus_input_file/faisal_sc.nessus'));
                $json   = json_encode($xml);
                $nessus = json_decode($json,TRUE);

                // Counting ReportHosts
                $count=0;
                foreach($nessus['Report']['ReportHost'] as $something){
                    $count = $count+1;
                }


                // Making Array of counted vulnerabilities
                $array = [];
                for($i=0; $i<$count; $i++){

                    if(isset($nessus['Report']['ReportHost'][$i]['ReportItem']['1'])){

                        $jcount = count($nessus['Report']['ReportHost'][$i]['ReportItem']);
                        $array[$i] = $jcount;

                    }else{

                        $jcount = 1;
                        $array[$i] = $jcount;

                    }

                }

            // ======================= Table 1 ================================ //


                preg_match_all('~(?<=<HostProperties>).*?(?=</HostProperties)~s', $reading, $host_properties);

                $count_out = 0;
                $count_in  = 0;
                $array_hostproperties;
                foreach($host_properties[0] as $host_property){

                    $result_host_ip = preg_match('#(?<=("host-ip">))((?:.|\n)*?)(?=</tag)#', $host_property, $host_ip);
                    if($result_host_ip){

                        $array_hostproperties[$count_out][$count_in] = $host_ip[0];
                        $count_in = $count_in + 1;

                    }
                    else{
                        // echo " - ";
                    }


                    $result_mac = preg_match('#(?<=("mac-address">))((?:.|\n)*?)(?=</tag)#', $host_property, $mac);
                    if($result_mac == 1){
                        // var_dump(htmlspecialchars($mac[0]));
                        $array_hostproperties[$count_out][$count_in] = $mac[0];
                        $count_in = $count_in + 1;
                    }
                    elseif($result_mac == 0){
                        $result_os = preg_match('#(?<=("os">))((?:.|\n)*?)(?=</tag)#', $host_property, $os);
                        if($result_os){
                            // echo "OS = ";
                            // var_dump(htmlspecialchars($os[0]));
                            $array_hostproperties[$count_out][$count_in] = $os[0];
                            $count_in = $count_in + 1;
                        }else{
                            // echo " - ";
                            $array_hostproperties[$count_out][$count_in] = " - ";
                            $count_in = $count_in + 1;
                        }
                    }



                    $result_system_type = preg_match('#(?<=("system-type">))((?:.|\n)*?)(?=</tag)#', $host_property, $system_type);
                    if($result_system_type){
                        // var_dump(htmlspecialchars($system_type[0]));
                        $array_hostproperties[$count_out][$count_in] = $system_type[0];
                        $count_in = $count_in + 1;
                    }else{
                        // echo " - ";
                        $array_hostproperties[$count_out][$count_in] = " - ";
                        $count_in = $count_in + 1;
                    }


                    $result_operating_system = preg_match('#(?<=("operating-system">))((?:.|\n)*?)(?=</tag)#', $host_property, $operating_system);
                    if($result_operating_system){
                        // var_dump(htmlspecialchars($operating_system[0]));
                        $array_hostproperties[$count_out][$count_in] = $operating_system[0];
                        $count_in = $count_in + 1;
                    }else{
                        // echo " - ";
                        $array_hostproperties[$count_out][$count_in] = " - ";
                        $count_in = $count_in + 1;
                    }

                    $array_hostproperties[$count_out][$count_in] = $array[$count_out];
                    $count_in = 0;

                    $count_out = $count_out + 1;
                }

                // ----------- Sorting array according to count of vulnerability -------------//


                $new_array = array();
                foreach ($array_hostproperties as $key => $value)
                {
                    $new_array[$key] = $value['4'];

                }
                array_multisort($new_array, SORT_DESC, $array_hostproperties);

                // echo '<pre>';
                // return var_dump($array_hostproperties); 
                // echo '</pre>';

                // ---------- Calling Most_Vulnerable_Asset model function to store most vulnerable assets

                $Most_Vulnerable_Asset = new Most_Vulnerable_Asset();
                
                $Most_Vulnerable_Asset->store($array_hostproperties);
                    


        

            // ------------------- PHP WORD table 1 --------------------------------------//

                $section->addText('TABLE 1: List of most vulnerable assets in the client’s network',array('name' => 'Tahoma', 'size' => 14, 'color'=>'red', 'italic'=>true) );
                $section->addTextBreak(1);
                $table =$section->addTable();
                $table->addRow(900);
                $table->addCell(1000)->addText('Sr.', array('color'=>'006699'));
                $table->addCell(2500)->addText('IP Address', array('color'=>'006699'));
                $table->addCell(3000)->addText('MAC Address', array('color'=>'006699'));
                $table->addCell(3500)->addText('Asset Type*', array('color'=>'006699'));
                $table->addCell(2500)->addText('Count', array('color'=>'006699'));

                $table_1 = $section->addTable();

                $Most_Vulnerable_Asset = new Most_Vulnerable_Asset();
                $array_hostproperties = $Most_Vulnerable_Asset->read();

                foreach($array_hostproperties as $host_property){
                    $table_1->addRow(900);
                    $table_1->addCell(1000)->addText($host_property->id);
                    $table_1->addCell(2500)->addText($host_property->ip);
                    $table_1->addCell(3000)->addText($host_property->mac);
                    $table_1->addCell(3000)->addText($host_property->asset_type.'                                        '.$host_property->operating_system);
                    $table_1->addCell(2500)->addText('        '.$host_property->count);

                }




            // ======================= Table 2 ================================ //


                // -----------Plugin name extraction from report items using xml json -------------//
                $count=0;
                foreach($nessus['Report']['ReportHost'] as $something){
                    $count = $count+1;
                }


                // Making Array of counted vulnerabilities
                $report_items = [];

                $plugin_name_array = [];
                $counter = 0;


                for($i=0; $i<$count; $i++){

                    if(isset($nessus['Report']['ReportHost'][$i]['ReportItem']['1'])){

                        $jcount = count($nessus['Report']['ReportHost'][$i]['ReportItem']);

                        for($j=0; $j<$jcount; $j++)
                        {

                            $plugin_name_array[$counter] = $nessus['Report']['ReportHost'][$i]['ReportItem'][$j]['@attributes']['pluginName'];

                            $counter = $counter + 1;

                        }

                    }else{

                        $jcount = 1;

                        for($j=0; $j<$jcount; $j++)
                        {

                            $plugin_name_array[$counter] = $nessus['Report']['ReportHost'][$i]['ReportItem']['@attributes']['pluginName'];
                            $counter = $counter + 1;

                        }

                    }

                }

                $plugin_name_array_count = array_count_values($plugin_name_array);

                $old_plugin_name_array_count = $plugin_name_array_count;
                rsort($plugin_name_array_count);
                $new_plugin_name_array_count = [];

                foreach($plugin_name_array_count as $plugin_name => $count){
                    foreach($old_plugin_name_array_count as $old_plugin_name => $old_count){
                        if($count == $old_count){
                            $new_plugin_name_array_count[$old_plugin_name] = $count;
                        }
                    }
                }

                // Making a final array having arrays of vulnerability and count
                $new_plugin_array = [];
                $i=0;
                foreach($new_plugin_name_array_count as $key => $value){
                    $new_plugin_array[$i] = [$key,$value];
                    $i = $i + 1;
                }

                // ---------- Calling Vulnerability model function to store Vulnerability List

                $Vulnerability = new Vulnerability();
                
                $Vulnerability->store($new_plugin_array);
    


            //------------------- PHP WORD Table 2 --------------------------------------//

                $section->addTextBreak(1);
                $section->addText('TABLE 2: Top 10 Vulnerability names with its total count / occurence',array('name' => 'Tahoma', 'size' => 14, 'color'=>'red', 'italic'=>true) );
                $section->addTextBreak(1);
                $table2 = $section->addTable();
                $table2->addRow(100);
                $table2->addCell(15000)->addText('Exploit Category', array('color'=>'006699'));
                $table2->addCell(2500)->addText('Infected Assets', array('color'=>'006699'));

                $table_3 = $section->addTable();


                // Creating Object of Vulnerability Model Class 
                $Vulnerability = new Vulnerability();
                $new_plugin_array = $Vulnerability->read();

                $counter=0;

                foreach($new_plugin_array as $new){
                    if($counter<10){
                        $table_3->addRow(100);
                        $table_3->addCell(15000)->addText(htmlspecialchars($new->vulnerability));
                        $table_3->addCell(2500)->addText('          '.htmlspecialchars($new->count));
                    }
                    $counter = $counter + 1;
                }    
        

            // ======================= Table 3 ================================ //

                //--------- Retriveing all the vulnerabilities and its description + solution ------//
                $count=0;
                foreach($nessus['Report']['ReportHost'] as $something){
                    $count = $count+1;
                }


                $plugin_name_array = [];
                $counter = 0;
                for($i=0; $i<$count; $i++){

                    $jcount = count($nessus['Report']['ReportHost'][$i]['ReportItem']);

                    for($j=0; $j<$jcount; $j++)
                    {
                        if(!in_array([$nessus['Report']['ReportHost'][$i]['ReportItem'][$j]['plugin_name'], $nessus['Report']['ReportHost'][$i]['ReportItem'][$j]['description'], $nessus['Report']['ReportHost'][$i]['ReportItem'][$j]['solution']],$plugin_name_array)){

                                $plugin_name_array[$counter] = [$nessus['Report']['ReportHost'][$i]['ReportItem'][$j]['plugin_name'], $nessus['Report']['ReportHost'][$i]['ReportItem'][$j]['description'], $nessus['Report']['ReportHost'][$i]['ReportItem'][$j]['solution']];
                                $counter = $counter + 1;
                        }        

                    }

                }

                $Vulnerabilitydetail = new Vulnerabilitydetail();
                $Vulnerabilitydetail->store($plugin_name_array);


                //--------------Retrieving all the ips and mac that are common in a vulnerability------------//

                $array_ip = [];
                $array_plugin_name = [];

                for($i=0; $i<$count; $i++){

                        $match_mac="-";
                        foreach($nessus['Report']['ReportHost'][$i]['HostProperties']['tag'] as $each){


                                if(preg_match('~^([0-9a-fA-F][0-9a-fA-F]:){5}([0-9a-fA-F][0-9a-fA-F])$~', $each, $mac)){

                                    $match_mac = $mac[0];

                                }


                        }

                        $jcount = count($nessus['Report']['ReportHost'][$i]['ReportItem']);
                        for($j=0; $j<$jcount; $j++)
                        {

                            if(array_key_exists($nessus['Report']['ReportHost'][$i]['ReportItem'][$j]['plugin_name'] ,$array_plugin_name )){


                                    if(!in_array($nessus['Report']['ReportHost'][$i]['@attributes']['name'], $array_plugin_name[$nessus['Report']['ReportHost'][$i]['ReportItem'][$j]['plugin_name']]) ){

                                        array_push($array_plugin_name[$nessus['Report']['ReportHost'][$i]['ReportItem'][$j]['plugin_name']], $nessus['Report']['ReportHost'][$i]['@attributes']['name'], $match_mac);

                                    }

                            }

                            else{

                                $array_plugin_name[$nessus['Report']['ReportHost'][$i]['ReportItem'][$j]['plugin_name']] = [$nessus['Report']['ReportHost'][$i]['@attributes']['name'], $match_mac];

                            }

                            // if(array_key_exists($nessus['Report']['ReportHost'][$i]['ReportItem'][$j]['plugin_name'] ,$array_plugin_name )){

                            //  array_push($array_plugin_name[$nessus['Report']['ReportHost'][$i]['ReportItem'][$j]['plugin_name']], 'IP'->$nessus['Report']['ReportHost'][$i]['@attributes']['name'], 'MAC'->$match_mac);

                            // }

                            // else{

                            //  $array_plugin_name[$nessus['Report']['ReportHost'][$i]['ReportItem'][$j]['plugin_name']] = ['IP'->$nessus['Report']['ReportHost'][$i]['@attributes']['name'], 'MAC'->$match_mac];

                            // }


                        }


                } 

                $Vulnerabilitydetail_ip_mac = new Vulnerabilitydetail_ip_mac;
                $Vulnerabilitydetail_ip_mac->store($array_plugin_name);



            //------------------- PHP WORD Table 3 --------------------------------------//

                $section->addTextBreak(1);
                $section->addText('TABLE 3: Vulnerability detail with description, remedy(fix), occurances',array('name' => 'Tahoma', 'size' => 14, 'color'=>'red', 'italic'=>true) );
                $section->addTextBreak(1);


                // // --- Retrieving all the details from both models Vulnerabilitydetail $ Vulnerabilitydetail_ip_mac 
                // $vulnerability = Vulnerabilitydetail_ip_mac::all();
                // $array_new = array();
                // $final_array = array();
                // $count = 0;
                // foreach($vulnerability as $each){
                    
                //     $v = Vulnerabilitydetail::find($each->vulnerability_detail_id);
                    
                //     if(!in_array($v->vulnerability, $array_new)){

                //         $array_new[$count] = $v->vulnerability;
                //         // echo $v->vulnerability.'     ';
                //         // echo '<br>';
                //         // echo $v->description.'       ';
                //         // echo '<br>';
                //         // echo $v->solution.'        ';

                //         // echo "</pre>";
                //         // echo '<br>';

                //         $count = $count + 1;
                //     }    
                    

                //     echo $each->id.'   '.$each->ip.'    '.$each->mac;

                //     echo '<br>';
                //     echo '<br>';
                //     echo '<br>';
                    
                // }
                //------------------------- End ---------------------------//


                //------------------------ Experimenting Retrieving Records --------------------------------//

                //     // Creating Object of Vulnerabilitydetail and Vulnerabilitydetail_ip_mac Model Class 
                //     $Vulnerabilitydetail_ip_mac = new Vulnerabilitydetail_ip_mac();
                //     $plugin_name_array = $Vulnerabilitydetail_ip_mac->read();


                // echo "<pre>";
                // foreach($plugin_name_array as $each){
                //     // var_dump($each->ip);

                //     $vulnerabilities_detail = $Vulnerabilitydetail_ip_mac->with('Vulnerabilitydetail')->find($each->vulnerability_detail_id); 
                //     var_dump($vulnerabilities_detail->Vulnerabilitydetail->description);
                //     // echo $vulnerabilities_detail->description;
                //     // echo $vulnerabilities_detail->solution;



                //     echo '<br>';
                // }
                // echo "</pre>";

                $vulnerability = Vulnerabilitydetail_ip_mac::all();
                $array_new = array();
                $count = 0;
                $counter = 1;

                foreach($vulnerability as $each){

                        $v = Vulnerabilitydetail::find($each->vulnerability_detail_id);
                    
                        if(!in_array($v->vulnerability, $array_new)){

                            $array_new[$count] = $v->vulnerability;

                            $section->addText($v->id.'. '.htmlspecialchars($v->vulnerability),array('name' => 'Tahoma', 'size' => 12, 'color'=>'black', 'bold'=>true) );
                            $section->addTextBreak(1);


                            $table4 = $section->addTable();
                            $table4->addRow(100);
                            $table4->addCell(3000)->addText('           Description', array('color'=>'black', 'bold'=>true));
                            $table4->addCell(13000)->addText($v->description, array('color'=>'006699'));

                            $table4->addRow(100);
                            $table4->addCell(3000)->addText('           Remediation', array('color'=>'black', 'bold'=>true));
                            $table4->addCell(13000)->addText($v->solution, array('color'=>'006699'));
                        


                            $section->addTextBreak(1);
                            $section->addText('Following is the list of assets with this vulnerability:',array('name' => 'Tahoma', 'size' => 12, 'color'=>'black') );
                            $section->addTextBreak(1);

                            $table5 = $section->addTable();
                            $table5->addRow(100);
                            $table5->addCell(2000)->addText('S. No.', array('color'=>'black', 'italic'=>true, 'bold'=>true));
                            $table5->addCell(8000)->addText('IP', array('color'=>'black', 'italic'=>true, 'bold'=>true));
                            $table5->addCell(6000)->addText('MAC', array('color'=>'black', 'italic'=>true, 'bold'=>true));
                            $section->addTextBreak(1);


                            $count = $count + 1;
                            $counter = 1;

                        }    


                        $table5->addRow(100);
                        $table5->addCell(2000)->addText($counter.' ', array('color'=>'006699'));
                        $table5->addCell(8000)->addText($each->ip, array('color'=>'006699'));
                        $table5->addCell(6000)->addText($each->mac, array('color'=>'006699'));



                        $section->addTextBreak(1);
                        $counter = $counter + 1;

                }



            // ------------PHPWORD Writer - Output Word Document ----------------------//

                $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
                $file = 'HelloWorld.docx';
                $objWriter->save($file);
                
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


    public function pdf(){

    	return 'pdf file';

    }
	
	public function excel(){

    	return 'excel file';

    }

    public function webpage(){

    	return 'Webpage';

    }

}
