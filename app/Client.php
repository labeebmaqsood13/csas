<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

	protected $table = 'clients';
    protected $fillable = ['name', 'user_id'];

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function project(){
    	return $this->hasMany('App\Project');
    }
    
}
