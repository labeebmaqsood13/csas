<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
	protected $table = 'tasks';
    protected $fillable = ['name', 'phase'];

    public function detailstask(){
    	return $this->hasMany('App\Detailstask');
    }
}
