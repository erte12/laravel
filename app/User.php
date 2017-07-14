<?php

namespace App;

use Illuminate\Notifications\Notifiable;
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
        'name', 'email', 'role_id', 'password', 'sex',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function friendsOfPerson()
    {
        return $this->belongsToMany('App\User', 'friends', 'user_id', 'friend_id')->wherePivot('accepted', 1);
;
    }

    public function friendsOfMine()
    {
        return $this->belongsToMany('App\User', 'friends', 'friend_id', 'user_id')->wherePivot('accepted', 1);;
    }

    public function friends()
    {
        return $this->friendsOfMine->merge($this->friendsOfPerson);
    }

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function role()
    {
        return $this->belongsTo('App\Role');
    }
}
