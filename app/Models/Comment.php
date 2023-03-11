<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    /** relations */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function idea()
    {
        return $this->belongsTo('App\Model\Idea', 'idea_id')->withDefult();
    }
}
