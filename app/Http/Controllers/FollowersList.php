<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FollowersList extends Controller
{
    public function followers($id)
    {
        $user = User::findOrFail($id);
        $authUser = Auth::user();

        $followers = $user->followers->map(function ($follower) use ($authUser) {

            $follower->is_following = $authUser
                ->followings()
                ->where('followed_id', $follower->id)
                ->exists();

            return $follower;
        });

        return response()->json([
            'followers' => $followers
        ], 200);
    }

    public function followings($id)
    {
        $user = User::findOrFail($id);
        $authUser = Auth::user();

        $followings = $user->followings->map(function ($following) use ($authUser) {

            $following->is_following = $authUser
                ->followings()
                ->where('followed_id', $following->id)
                ->exists();

            return $following;
        });

        return response()->json([
            'followings' => $followings
        ], 200);
    }
}
