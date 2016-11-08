<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';
    protected $fillable = ['name', 'subnet_from', 'subnet_to', 'location', 'due_date', 'descrition', 'status', 'user_type', 'client_id'];

    public function client(){
    	return $this->belongsTo('App\Client');
    }

    public function user(){
    	return $this->belongsToMany('App\User');
    }
}
