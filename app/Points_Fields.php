<?php

namespace gexo;

use Illuminate\Database\Eloquent\Model;

class Points_Fields extends Model
{
	protected $table = 'points_fields';

    protected $fillable = ['user_id', 'field_id', 'points'];

    public function fields(){
    	return $this->belongsTo('gexo\Field');
    }

    public function user(){
    	return $this->belongsTo('gexo\User');
    }
}
