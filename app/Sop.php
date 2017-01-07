<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sop extends Model
{
    protected $table = 'sops';

    protected $fillable = ['phase_id','project_id'];

    public function project(){
    	return $this->belongsTo('App\Project');
    }
    
    public function phase(){
    	return $this->belongsTo('App\Phase');
    }
}
