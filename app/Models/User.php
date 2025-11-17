<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'bio',
        'profile_pic',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // User I follow
    public function followings(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'user_follows', // pivot table
            'follower_id', // foreign key on pivot pointing at me
            'followed_id', // foreign key on pivot pointing who i follow
        )->withTimestamps();
    }

    // User who Follow me
    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'user_follows',
            'followed_id', // foreign key on pivot pointing at me
            'follower_id', // foreign key on pivot pointing to my follower
        )->withTimestamps();
    }

    public function isNotSelf(): bool
    {
        return Auth::check() && Auth::id() !== $this->id;
    }

    // Accessor for profile_pic incase of null , so fallback to defaul url
    public function getProfilePicAttribute()
    {
        return $this->attributes['profile_pic'] ??
            "https://res.cloudinary.com/dgy9djne0/image/upload/v1751614201/avatar_jlzpqv.jpg";
    }

    /* ------------------------------------------------
    *             FOR POSTS
    * ------------------------------------------------
    */

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function bookmarkedPosts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'bookmarks');
    }


    /* ------------------------------------------------
    *             FOR USERS SUGGESTIONS
    * ------------------------------------------------
    */
    public function getMyFriendsFollowing()
    {
        $myfollowing = $this->followings()->pluck('users.id');

        return DB::table('user_follows')
            ->whereIn('follower_id', $myfollowing) // finding my friends followers
            ->pluck('followed_id') // getting my friends followers ids
            ->unique()
            ->diff($myfollowing) // excluding my friends
            ->diff([$this->id]) // excluding myself
            ->values();
    }

    public function getFriendSuggestions($limit = 5)
    {
        $suggestIds = $this->getMyFriendsFollowing();

        $remaining = $limit - count($suggestIds);

        // if not enough suggestins fill with popular users
        $popularUserIds = collect();

        if ($remaining > 0) {
            $popularUserIds = User::withCount('followers')
                ->orderByDesc('followers_count')
                ->whereNotIn('id', $suggestIds) // avoid duplicates
                ->whereNotIn('id', $this->followings()->pluck('users.id')) // exclude people I already follow
                ->where('id', '!=', $this->id) // exclude myself
                ->take($remaining)
                ->pluck('id');
        }

        $finalIds = $suggestIds->merge($popularUserIds);

        return User::whereIn('id', $finalIds)->get();
    }

    // Get popular users only (for guests)
    public static function getPopularUsers($limit = 5)
    {
        return User::withCount('followers')
            ->orderByDesc('followers_count')
            ->take($limit)
            ->get();
    }
}
