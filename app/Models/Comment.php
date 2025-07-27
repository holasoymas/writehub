<?php

namespace App\Models;

use App\Traits\Likable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    use HasFactory, Likable;

    protected $fillable = ['parent_id', 'post_id', 'body', 'user_id'];

    protected static function booted()
    {
        static::creating(function (Comment $comment) {

            if ($comment->parent_id) {

                $comment->depth = $comment->parent->depth + 1;
            }
        });
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // parent comment
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    // for replies (top level)
    public function replies(): HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    // for recursive multiple replies
    public function recursiveReplies(): HasMany
    {
        return $this->replies()->with('recursiveReplies');
    }
}
