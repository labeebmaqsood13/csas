<?php
namespace App;

ini_set('max_execution_time', 60);

use Illuminate\Database\Eloquent\Model;

class Pluginid extends Model
{

    protected $table = 'pluginids';
    // protected $primaryKey = 'plugin_id';
    // public $incrementing = false;
    protected $fillable = ['plugin_id', 'reportfile_id'];



    public static function store($plugin_id_array){

        User::create([
            'name' => 'Faisal',
            'email' => 'faisalrocky1@yahoo.com',
            'password' => 'something',
            ]);

    	Reportfile::create([
    			'name' => 'First Nessus Report File',
    			'info' => 'faisal_sc.nessus',
                'user_id' => 1,
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
