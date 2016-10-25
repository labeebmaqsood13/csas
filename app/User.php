<?php

namespace App;

use Hash;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Junaidnasir\Larainvite\InviteTrait;

class User extends Authenticatable
{
    use InviteTrait;
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

    public function setPasswordAttribute($pass){

        $this->attributes['password'] = Hash::make($pass);

    }
}