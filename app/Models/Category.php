<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    /** relations */
    public function users()
    {
        return $this->hasMany(Idea::class);
    }

    // public function ideas()
    // {
    //     return $this->hasMany(IdeaCategory::class);
    // }
}