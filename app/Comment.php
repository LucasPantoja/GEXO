<?php

namespace gexo;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = array('text');
    
    protected $guarded = ['id', 'question_id', 'user_id'];

    public function question(){
    	return $this->belongsTo('gexo\Question');
    }

    public function user(){
    	return $this->belongsTo('gexo\User');
    }
}
