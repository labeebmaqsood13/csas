<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
	protected $table = 'tasks';
    protected $fillable = ['name', 'phase'];

    public function assignment(){
    	return $this->hasMany('App\Assignment');
    }
}
