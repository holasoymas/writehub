<?php

namespace App\Services;

use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class FeedRankingService
{
    protected float $ALPHA; // for like weight
    protected float $BETA; // for comment weight
    protected float $GAMMA; // for time decay
    protected float $THETA; // for follow graph boost
    protected float $LAMBDA; // for network popularity

    public function __construct()
    {
        $this->ALPHA = 1.0;
        $this->BETA = 1.5;
        $this->GAMMA = 1.3;
        $this->THETA = 1.5;
        $this->LAMBDA = 1.5;
    }


    /**
     * @param  Collection<int, Post>  $posts
     * @param  User|null              $viewer
     * @return Collection<int, Post>
     */

    public function rankPosts(Collection $posts, ?User $viewer): Collection
    {
        $scored = $posts->map(function (Post $post) use ($viewer): Post {
            // compute primitive values locally (no dynamic public props)

            $POPULARITY = $this->calculatePopularity($post);
            $TIME_DECAY = $this->calculateTimeDecay($post);
            $FOLLOW_GRAPH_BOOST = $this->calculateFollowGraphBoost($post, $viewer);
            $NETWORK_POPULARITY = $this->calculateNetworkPopularity($post, $viewer);

            $FINAL_SCORE = (($POPULARITY + $NETWORK_POPULARITY) * $FOLLOW_GRAPH_BOOST) / $TIME_DECAY;

            $post->setAttribute('final_score', (float)$FINAL_SCORE);

            return $post;
        });

        $posts = $scored->sortByDesc(fn(Post $p) => $p->final_score)->values();

        return $posts;
    }

    public function calculatePopularity(Post $post): float
    {
        return ($this->ALPHA * $post->likes_count) + ($this->BETA * $post->comments_count);
    }


    public function calculateTimeDecay(Post $post): float
    {
        $daysAgo = Carbon::now()->diffInDays($post->created_at, true);

        return pow((int)$daysAgo + 2, $this->GAMMA);
    }

    public function calculateFollowGraphBoost(Post $post, ?User $viewer): float
    {
        if (!$viewer) return 1;

        $isFollowing = $viewer->followings()->where('followed_id', $post->user_id)->exists();

        return 1 + ($isFollowing ? $this->THETA : 0.0);
    }

    public function calculateNetworkPopularity(Post $post, ?User $viewer): float
    {
        if (!$viewer) return 0;

        // get viewrs followings ids
        $followingIds = $viewer->followings()->pluck('followed_id')->toArray();

        // count total following
        $totalFollowing = count($followingIds);

        // if none my following users like it dont give network score
        if (empty($followingIds)) return 0;

        // count how many following of my users, like this
        $likesFromFollowers = $post->likes()
            ->whereIn('user_id', $followingIds)
            ->count();

        // normalizing and returning
        return $this->LAMBDA * ($likesFromFollowers / $totalFollowing);
    }
}
