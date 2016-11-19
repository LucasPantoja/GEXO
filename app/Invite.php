<?php

namespace gexo;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{

    protected $fillable = array('key', 'from_user_id');
    
    protected $guarded = ['id'];
}
