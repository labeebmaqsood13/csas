<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';
    protected $fillable = ['name', 'location', 'client_id', ''];

    public function client(){
    	return $this->belongsTo('App\Client');
    }
}
