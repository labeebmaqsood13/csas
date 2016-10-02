<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pluginid extends Model
{

    protected $table = 'pluginids';
    // protected $primaryKey = 'plugin_id';
    // public $incrementing = false;
    protected $fillable = ['plugin_id', 'reportfile_id'];



    public function store($plugin_id_array){

    	Reportfile::create([
    			'name' => 'First Nessus Report File',
    			'info' => 'faisal_sc.nessus',
    		]);

    	foreach($plugin_id_array as $plugin_id){
			Pluginid::create([
				'plugin_id'		=>  $plugin_id,
				'reportfile_id' =>  1,
				]);
    	}

    }

    public function Reportfile(){

    	return $this->belongsTo('App\Reportfile');

    }

}
