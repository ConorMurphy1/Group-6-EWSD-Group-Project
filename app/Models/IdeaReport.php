<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdeaReport extends Model
{
    use HasFactory;

    protected $guarded = [];

    /** relations */
    public function reporter()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function idea()
    {
        return $this->belongsTo(Idea::class);
    }
}
