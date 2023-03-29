<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentReport extends Model
{
    use HasFactory;

    /** relations */
    public function reporter()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}
