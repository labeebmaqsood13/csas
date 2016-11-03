<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dummy extends Model
{
    protected $table = 'dummys';
    // protected $primaryKey = 'plugin_id';
    // public $incrementing = false;
    protected $fillable = ['name'];
}
