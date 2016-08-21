<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadNmapRequest;

use Illuminate\Http\Request;

use App\Http\Requests;

class NmapController extends Controller
{

    public function upload(UploadNmapRequest $request){

        $nmap_file_upload = $request->file('nmap_file_upload');

        if($nmap_file_upload){
            // $nmap_file_uploaded_name = $nmap_file_upload->getClientOriginalName();
            $nmap_file_uploaded_name = 'scan.txt'; 
            $nmap_file_upload->move(public_path('includes/nmap_input_file'), $nmap_file_uploaded_name);
        }

        return \Redirect::route('home')->with('message', 'Nmap File Uploaded');

    }

    public function word(){

    	return 'word file';

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
