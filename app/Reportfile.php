<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reportfile extends Model
{
	protected $table = 'reportfiles';
    protected $fillable = ['info','name'];

    public function Pluginid(){

		return $this->hasMany('App\Pluginid');

    }

}
