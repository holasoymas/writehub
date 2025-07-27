<?php

namespace App\Traits;

use App\Models\Like;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Likable
{
    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'likable');
    }

    public function getLikesCountAttribute(): int
    {
        return $this->likes()->count();
    }

    public function isLikedBy($user = null): bool
    {
        if (!$user) return false;

        return $this->likes()->where('user_id', $user->id)->exists();
    }
}
