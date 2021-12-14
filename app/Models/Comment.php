<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * Returns the profile of the user who posted this comment.
     */
    public function userProfile()
    {
        return $this->belongsTo(UserProfile::class);
    }

    /**
     * Returns the post which this comment belongs to.
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
