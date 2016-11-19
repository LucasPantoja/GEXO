<?php

namespace gexo;

use Illuminate\Database\Eloquent\Model;

class Alternative extends Model
{
    public $timestamps = false;

    protected $fillable = array('text', 'answer');
    
    protected $guarded = ['id', 'question_id'];

    public function question(){
    	return $this->belongsTo('gexo\Question');
    }
}
