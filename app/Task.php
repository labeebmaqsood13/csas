<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
	protected $table = 'tasks';
    protected $fillable = ['name', 'phase_id'];

    public function assignment(){

    	return $this->hasMany('App\Assignment');
    
    }

    public function phase(){

    	return $this->belongsTo('App\Phase');

    }


    public function reportfile(){
        return $this->hasOne('App\Reportfile');
    }

}
