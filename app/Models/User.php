<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\This;

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
}
