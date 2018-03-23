<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'name', 
        'description',
        'days',
        'hours',
        'project_id',
        'user_id',
    ];

    // belongsTo
    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }

    //belongsToMany
    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }

    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'commentable');
    }
}
