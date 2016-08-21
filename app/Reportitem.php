<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reportitem extends Model
{
	protected $table = 'reportitems';
	protected $fillable = ['port','svc_name','protocol','severity','plugin_id','plugin_name','plugin_family','description','risk_factor','solution'];
	protected $hidden = [];


    public function reporthost(){
    	
    	return $this->belongsTo('App\Reporthost');

    }
}
