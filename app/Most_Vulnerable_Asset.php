<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Most_Vulnerable_Asset extends Model
{
    public $table = 'most_vulnerable_assets';
    protected $fillable = ['ip','mac','asset_type','count'];


    public function store($array_of_most_vulnerable_assets){

    	$count = sizeof($array_of_most_vulnerable_assets);

    	for($i=0; $i<$count; $i++){
    		Most_Vulnerable_Asset::create([
    			'ip' 		 		=>  $array_of_most_vulnerable_assets[$i][0],
    			'mac' 		 		=>  $array_of_most_vulnerable_assets[$i][1],
    			'asset_type' 		=>  $array_of_most_vulnerable_assets[$i][2], 
    			'opeating_system'   =>  $array_of_most_vulnerable_assets[$i][3], 
    			'count'			    =>  $array_of_most_vulnerable_assets[$i][4], 
    					]);

    	}

	}   

	public function read(){

		$most_vulnerable_assets = $this->all();
		return $most_vulnerable_assets;

	}

}















