<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tests(){

        return $this->hasMany('App\Test');
    }

    public function passport(){

        return $this->hasOne('App\Passport');
    }

    public function mobiles(){

        return $this->hasMany('App\Mobile');
    }

    public function roles(){

        return $this->belongsToMany('App\Role')->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany('App\User');
    }

}
