<?php

namespace App;

use Hash;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // public function create(){

    //     User::create([
    //         'name' =>
    //         ]);

    // }

    public function role(){

        return $this->belongsToMany('App\Role');

    }

    public function user_invitation(){

        return $this->hasMany('App\Userinvitation');
    
    }

    public function client(){

        return $this->hasMany('App\Client');
    
    }

    public function project(){
        return $this->belongsToMany('App\Project');
    }

    public function setPasswordAttribute($pass){

        $this->attributes['password'] = Hash::make($pass);

    }
}