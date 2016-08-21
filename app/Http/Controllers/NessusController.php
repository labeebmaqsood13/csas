<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadNessusRequest;

use App\Most_Vulnerable_Asset;

use App\Vulnerability;

use App\Vulnerabilitydetail;

use App\Vulnerabilitydetail_ip_mac;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\File;

use phpoffice\phpword;

use Session;


class NessusController extends Controller
{

    public function upload(UploadNessusRequest $request){

            $nessus_file_upload = $request->file('nessus_file_upload');

            $nessus_content = File::get($nessus_file_upload);

            if($nessus_file_upload){
                // $nessus_filename = $nessus_file_upload->getClientOriginalName();
                $nessus_filename = 'faisal_sc.nessus'; 
                $new_path = public_path('includes/nessus_input_file');
                $nessus_file_upload->move( $new_path, $nessus_filename );
            }

            $this->save($new_path, $nessus_filename); 

            // echo "<pre>";
            // var_dump($display);
            // echo "</pre>";

            return \Redirect::route('home')->with('message', 'Nessus File Uploaded, Parsed and Stored in Database');


            // return \Redirect::route('home')->with('message', 'Nessus File Uploaded');

            // return \Redirect::action('NessusController@save')->with('nessus_file', $nessus_content);
            // Below is the Alternate to above line
            // Redirect with route return \Redirect::route('nessus.save')->with('nessus_file', $nessus_contents);

            // Redirect with passing array - return \Redirect::action('NessusController@save', array('contents'=>$contents));

            // Redirect with passing array - return \Redirect::route('nessus.save', [$contents]);

    }

    public function save($path_to_file_uploaded, $filename){

            // Below two lines fetching session array in a controller
            // $contents = Session::get('nessus_file');
            // return \Redirect::route('home')->with('message', 'Nessus File Uploaded, Parsed and Stored in Database');

            // Reading Nessus file 
            $reading = File::get($path_to_file_uploaded.'/'.$filename);


        

            // ---------------- XML to JSON -------------------------//


            $xml    = simplexml_load_file($path_to_file_uploaded.'/'.$filename);
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


    }



    public function word(){

            // ---------------- PHPWord ---------------------- //    
            
                // $reading = File::get(public_path('includes/nessus_input_file/faisal_sc.nessus'));
                // \PhpOffice\PhpWord\Autoloader::register();  
                $phpWord = new \PhpOffice\PhpWord\PhpWord();
                $section = $phpWord->createSection();

                $section->addText('NSPR Report.',array('name' => 'Tahoma', 'size' => 18, 'italic'=>true, 'color'=>'006699') );
                $section->addTextBreak(1);


        

            // ------------------- table 1 --------------------------------------//

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

            //------------------- Table 2 --------------------------------------//

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
        
            //------------------- Table 3 --------------------------------------//

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
