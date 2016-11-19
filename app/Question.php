<?php

namespace gexo;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{	
	public $timestamps = false;

    protected $fillable = array('enunciation', 'level', 'valid', 'field_id', 'user_id', 'imagem');
    
    protected $guarded = ['id'];

    public function alternatives(){
    	return $this->hasMany('gexo\Alternative');
    }

    public function comments(){
    	return $this->hasMany('gexo\Comment');
    }

    public function field(){
        return $this->belongsTo('gexo\Field');
    }

    public function user(){
    	return $this->belongsTo('gexo\User');
    }
}
