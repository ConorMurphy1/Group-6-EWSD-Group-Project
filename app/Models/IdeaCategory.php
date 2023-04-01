<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdeaCategory extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function idea()
    {
        return $this->belongsTo('App\Models\Idea', 'idea_id')->withDefault();
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id')->withDefault();
    }
}
