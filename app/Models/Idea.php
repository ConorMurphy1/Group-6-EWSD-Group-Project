<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};
use Illuminate\Support\Facades\DB;

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

    public static function getAllIdea($event_id)
    {
        $result = DB::table('ideas')
                ->select(DB::raw("concat('Idea Title >> ', ideas.title) as title"), 
                         DB::raw("concat('Idea Description >> ', ideas.description) as description"), 
                         DB::raw("concat('User Name >> ', users.username) as username"), 
                         DB::raw("concat('Event Name >> ', events.name) as event_name"), 
                         DB::raw("concat('Is Anonymous >> ', ideas.is_anonymous) as is_anonymous"), 
                         DB::raw("concat('Document Attached Name >> ', ideas.document) as document"), 
                         DB::raw("concat('Idea View >> ', ideas.views) as views"), 
                         DB::raw("concat('Created at >> ', ideas.created_at) as created_at"), 
                         DB::raw("concat('Updated at >> ', ideas.updated_at) as updated_at"),   
                         DB::raw("concat('Deleted at >> ', ideas.deleted_at) as deleted_at"))
                ->where('ideas.event_id', $event_id)
                ->join('departments', 'departments.id', '=', 'ideas.department_id')
                ->leftJoin('events', 'events.id', '=', 'ideas.event_id')
                ->join('users', 'users.id', '=', 'ideas.user_id')         
                ->get()
                ->toArray();
        return $result;
    }
    
    
    
    
    
    
}
