<?php
namespace App;

ini_set('max_execution_time', 60);

use Illuminate\Database\Eloquent\Model;

use Auth;

class Pluginid extends Model
{

    protected $table = 'pluginids';
    // protected $primaryKey = 'plugin_id';
    // public $incrementing = false;
    protected $fillable = ['plugin_id', 'reportfile_id'];



    public static function store($plugin_id_array){

        // User::create([
        //     'name' => 'Someone',
        //     'email' => 'someone@yahoo.com',
        //     'password' => 'something',
        //     ]);

    	$reportfile = Reportfile::create([
    			'name' => 'First Nessus Report File',
    			'info' => 'faisal_sc.nessus',
                'user_id' => Auth::user()->id,
                // 'user_id' => 15,
    		]);

    	foreach($plugin_id_array as $plugin_id){
			Pluginid::create([
				'plugin_id'		=>  $plugin_id,
				'reportfile_id' =>  $reportfile->id,
				]);
    	}

    }

    public function Reportfile(){

    	return $this->belongsTo('App\Reportfile');

    }

}
