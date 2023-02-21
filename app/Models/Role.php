<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class role extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'role_entry';

    /** relations */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}