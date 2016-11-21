<?php

namespace gexo;

use Illuminate\Database\Eloquent\Model;

class Exercises extends Model
{
    protected $fillable = ['title', 'user_id', 'question_id', 'id']

    public function questions(){
    	return $this->hasMany('gexo\Question');
    }

    public function user(){
    	return $this->belongsTo('gexo\User');
    }
}
