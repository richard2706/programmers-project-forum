<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    /**
     * Returns the user associated with this profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Returns a list of the posts that this user has created.
     */
    public function posts() {
        return $this->hasMany(Post::class);
    }

    /**
     * Returns a list of all comments posted by this user.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
