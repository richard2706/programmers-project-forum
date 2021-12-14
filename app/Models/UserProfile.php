<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    /**
     * Returs the user associated with this profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Gets a list of the posts that this user has created.
     */
    public function posts() {
        return $this->hasMany(Post::class);
    }
}
