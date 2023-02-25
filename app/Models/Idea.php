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
    public function department()
    {
        return $this->belongsTo('App\Models\Department', 'department_id')->withDefault();
    }
}
