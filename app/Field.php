<?php

namespace gexo;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    public $timestamps = false;

    protected $fillable = array('title');
    
    protected $guarded = ['id'];

    public function questions(){
    	return $this->hasMany('gexo\Question');
    }

    public function points_fields(){
    	return $this->hasMany('gexo\Points_Fields');
    }
}
