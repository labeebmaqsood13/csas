<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reportfile extends Model
{
	protected $table = 'reportfiles';
    protected $fillable = ['info','name','user_id', 'project_id'];


	public static function store($name, $project_id, $information, $user_id){
		return Reportfile::create([
			'name'       => $name,
			'project_id' => $project_id,
			'info'       => $information,
			'user_id'    => $user_id,
			]);
	}

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function project(){
    	return $this->belongsTo('App\Project');
    }

    public function reporthost(){
    	return $this->hasMany('App\Reporthost');
    }

    public function pluginid(){
		return $this->hasMany('App\Pluginid');
    }

}
