<?php

namespace App\Models;

use App\Traits\Likable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use Likable;

    //NOTE: In an Eloquent model, the $casts property tells Laravel:
    // “Whenever you fetch this column from the database, automatically convert it into this PHP type.”
    protected $casts = ['content' => 'array'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'post_tag');
    }

    // only return the name of the tags eg : ['Laravel', 'web']
    public function getTagNamesAttribute(): array
    {
        return $this->tags->pluck('name')->all();
    }

    public function readableCreatedAt(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->created_at->format('M j, Y h:i A') // Example: Sep 10, 2025 03:45 PM
        );
    }

    public function estimatePostReadTime(): Attribute
    {
        return Attribute::make(
            get: function () {
                $word_count = str_word_count(strip_tags(json_encode($this->content)));
                return ceil($word_count / 200);
            }
        );
    }

    public function bookmarkedUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'bookmarks');
    }

    public function getIsBookmarkedAttribute()
    {
        return Auth::check() && $this->bookmarkedUsers->contains(Auth::id());
    }

    public function reports(): HasMany
    {
        return $this->hasMany(Report::class);
    }
}
