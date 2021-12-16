<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    /**
     * Gets all the posts associated with this tag.
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
