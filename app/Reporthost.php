<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reporthost extends Model
{
    protected $table = 'reporthosts';
    protected $fillable = ['host_end','policy_name','total_cves','cpe','os','operating_system','mac','host_start'];
    protected $hidden = [];


    public function reportitem(){

    	return $this->hasMany('App\Reportitem');

    }
}
