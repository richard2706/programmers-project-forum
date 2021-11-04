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
    public function user_profile() {
        return $this->belongsTo(UserProfile::class);
    }
}
