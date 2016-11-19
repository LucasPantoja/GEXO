<?php

namespace gexo;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'points', 'role'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function questions(){
        return $this->hasMany('gexo\Question');
    }

    public function comments(){
        return $this->hasMany('gexo\Comment');
    }

    public function socialaccounts(){
        return $this->hasMany('gexo\SocialAccount');
    }

}
