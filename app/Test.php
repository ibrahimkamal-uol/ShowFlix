<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Test extends Model
{
	public function user(){

        return $this->belongsTo('App\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function actors(){

        return $this->belongsToMany('App\Actor', 'actor_test')->withTimestamps();
    }
}
