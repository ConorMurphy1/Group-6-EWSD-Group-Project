<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function getFullNameAttribute()
    {
        return "{$this->firstname} {$this->lastname}";
    }

    public function getDepartmentCoordinatorsAttribute()
    {
        $coordinator = User::where('department_id', $this->department_id)
            ->where('role_id', 2)
            ->get();
        return $coordinator;
    }

    /** relations */
    public function role()
    {
        return $this->belongsTo('App\Models\Role', 'role_id')->withDefault();
    }

    public function department()
    {
        return $this->belongsTo('App\Models\Department', 'department_id')->withDefault();
    }

    public function reactions()
    {
        return $this->hasMany(IdeaReaction::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function ideas()
    {
        return $this->hasMany(Idea::class, 'user_id');
    }

    public function reports()
    {
        return $this->hasMany(IdeaReport::class);
    }

    public function commentReports()
    {
        return $this->hasMany(CommentReport::class);
    }
}
