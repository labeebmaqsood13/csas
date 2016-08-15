<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadNessusRequest;

use Illuminate\Http\Request;

use App\Http\Requests;


class NessusController extends Controller
{

    public function upload(UploadNessusRequest $request){

        $nessus_file_upload = $request->file('nessus_file_upload');

        if($nessus_file_upload){
            // $nessus_file_uploaded_name = $nessus_file_upload->getClientOriginalName();
            $nessus_file_uploaded_name = 'faisal_sc.nessus'; 
            $nessus_file_upload->move(public_path('includes/nessus_input_file'), $nessus_file_uploaded_name);
        }

        return \Redirect::route('home')->with('message', 'Nessus File Uploaded');

    }

    public function word(){

    	return 'word file'.' The file has been uploaded';

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
