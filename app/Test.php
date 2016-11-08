<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class test extends Model
{
    protected $fillable = [
    	'name',
    	'value',
    	'date'
    ];
}