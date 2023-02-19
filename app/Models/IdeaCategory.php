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
        return $this->belongsTo('App\Model\Idea', 'idea_id')->withDefult();
    }

    public function category()
    {
        return $this->belongsTo('App\Model\Category', 'category_id')->withDefult();
    }
}
