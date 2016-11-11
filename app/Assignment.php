<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $table = 'assignments';
    protected $hidden = [];

    protected $fillable = ['task_id', 'user_id', 'project_id', 'due_date'];

    public function task(){
    	return $this->belongsTo('App\Task');
    }

	public function project(){
		return $this->belongsTo('App\Project');
	}   

	public function user(){
		return $this->belongsTo('App\User');
	} 

}
