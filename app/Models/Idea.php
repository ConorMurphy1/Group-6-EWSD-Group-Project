<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Idea extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded=[];

    public function createdBy()
    {
        return $this->belongsTo('App\Models\User', 'user_id')->withDefault();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo('App\Models\Department', 'department_id')->withDefault();
    }

    public function event()
    {
        return $this->belongsTo('App\Models\Event', 'event_id')->withDefault();
    }

    public function reactions()
    {
        return $this->hasMany(IdeaReaction::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
