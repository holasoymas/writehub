<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

class Tag extends Model
{
    protected $fillable = ['name'];

    protected $hidden = ['created_at', 'updated_at', 'pivot'];

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'post_tag');
    }

    public function getRecommendedTags(?User $user, $limit = 5)
    {
        if (!$user) {
            return $this->getRecommendedTagsForGuest($limit);
        }

        return $this->getRecommendedTagsForUser($user, $limit);
    }

    // show ~50% of the most popular tags
    // ~50% random
    private function getRecommendedTagsForGuest($limit)
    {
        // getting popular tags
        $popularTags = $this->getPopularTags($limit / 2);

        // get random tags not in $popularTags
        $randomTags = DB::table('tags')
            ->whereNotIn('id', $popularTags)
            ->inRandomOrder()
            ->limit($limit - count($popularTags))
            ->pluck('id');

        $finalTagIds = $popularTags->merge($randomTags);

        $tags = DB::table('tags')->whereIn('id', $finalTagIds)->get();

        return $tags;
    }

    private function getRecommendedTagsForUser(User $user, $limit)
    {
        // get tags used by users
        $userTags = DB::table('post_tag')
            ->join('posts', 'post_tag.post_id', '=', 'posts.id')
            ->join('users', 'posts.id', '=', 'users.id')
            ->where('users.id', $user->id)
            ->select('post_tag.tag_id')
            ->limit(floor($limit / 2))
            ->pluck('tag_id');

        // get some popular tags
        $popularTags = $this->getPopularTags($limit / 3);

        $usersAndPopularTags = $userTags->merge($popularTags)->unique();

        // get rnadom tags
        $randomTags = DB::table('tags')
            ->whereNotIn('id', $usersAndPopularTags)
            ->inRandomOrder()
            ->limit($limit - count($usersAndPopularTags))
            ->pluck('id');

        $finalTagIds = $usersAndPopularTags->merge($randomTags);

        return DB::table('tags')->whereIn('id', $finalTagIds)->get();
    }

    private function getPopularTags($limit)
    {
        return DB::table('post_tag')
            ->select('tag_id', DB::raw('COUNT(post_id) as usage_count'))
            ->groupBy('tag_id')
            ->orderByDesc('usage_count')
            ->limit(floor($limit))
            ->pluck('tag_id');
    }
}
