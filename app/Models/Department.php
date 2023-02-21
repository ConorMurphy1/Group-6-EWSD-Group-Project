<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['name'];

    /** relations */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
