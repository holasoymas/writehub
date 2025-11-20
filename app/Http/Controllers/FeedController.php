<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use App\Services\FeedRankingService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FeedController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        $trendingBlogs = $this->getTrendingBlogs();

        $posts = Post::withCount(['likes', 'comments'])
            ->with('user', 'tags')->get();
        // Log::info(json_encode($posts, JSON_PRETTY_PRINT));

        $rankingPosts = (new FeedRankingService())->rankPosts($posts, $user);
        foreach ($rankingPosts as $posts) {
            Log::info($posts->final_score);
        }

        $tags = (new Tag())->getRecommendedTags($user, 10);

        if (!$user) {
            $recommendedFriends = (new User())->getFriendSuggestions(5);
        } else {
            $recommendedFriends = (new User())->getPopularUsers(5);
        }

        return view('welcome', compact("trendingBlogs", "rankingPosts", "tags", "recommendedFriends"));
    }

    public function getTrendingBlogs()
    {
        $oneWeekAgo = Carbon::now()->subDays(7);

        $trendingBlogs = Post::with('user')
            ->withCount([
                'likes as recent_likes' => function ($query) use ($oneWeekAgo) {
                    $query->where('created_at', '>=', $oneWeekAgo);
                },
                'comments as recent_comments' => function ($query) use ($oneWeekAgo) {
                    $query->where('created_at', '>=', $oneWeekAgo);
                }
            ])
            ->get()
            ->map(function ($blog) {
                // calculate score
                $blog->trending_score = $blog->recent_likes + ($blog->recent_comments * 2);

                return $blog;
            })
            ->sortByDesc('trending_score')
            ->take(6);

        return $trendingBlogs;
    }
}
