<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phase extends Model
{
	protected $table = 'phases';
    protected $fillable = ['name','is_default'];

    public function task(){

    	return $this->hasMany('App\Task');
   
    }
    public function sop(){

    	return $this->hasMany('App\Sop');
   
    }

}
