<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Comment extends Model
{

	protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function test()
    {
        return $this->belongsTo('App\Test');
    }
}
