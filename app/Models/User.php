<?php

namespace App;
namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
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
        'name', 
        'email', 
        'password',
        'first_name',
        'middle_name',
        'last_name',
        'city',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

    public function companies()
    {
        return $this->hasMany('App\Models\Company');
    }

    // public function comments()
    // {
    //     return $this->hasMany('App\Models\Comment');
    // }


    public function tasks()
    {
        return $this->belongsToMany('App\Models\Task');
    }
    public function projects()
    {
        return $this->belongsToMany('App\Models\Project');
    }

    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'commentable');
    }
}

