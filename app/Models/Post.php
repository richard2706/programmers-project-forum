<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * Gets the user profile of the user who posted this comment.
     */
    public function userProfile() {
        return $this->belongsTo(UserProfile::class);
    }

    /**
     * Gets all the comments associated with this post.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Gets all the tags associated with this post.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
