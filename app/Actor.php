<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
	public function tests(){

        return $this->belongsToMany('App\Test', 'actor_test')->withTimestamps();
    }
}
