<?php

namespace App\Models;

use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /** @use HasFactory<PostFactory> */
    use HasFactory;

    protected $table = 'posts';

    protected $guarded = [];

    function comments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->HasMany(Comment::class);
    }

    function tags(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
}
