<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Role extends Model
{

	protected $table = 'roles';
    protected $fillable = ['name'];

    public function user(){


    	return $this->belongsToMany('App\User');

    }


    public function user_invitation(){

        return $this->belongsToMany('App\Userinvitation');
    
    }
    

}
