<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userinvitation extends Model
{
    protected $table = 'userinvitations';
    protected $hidden = [];

    protected $fillable = ['code','email','status','valid_till', 'user_id'];


    public function user(){

        return $this->belongsTo('App\User');
    
    }

    public function role(){

        return $this->belongsToMany('App\Role');
    
    }

    public function project(){

        return $this->belongsToMany('App\Project');
    
    }
    
}
