<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FollowersList extends Controller
{
    public function followers($id)
    {
        $user = User::findOrFail($id);

        $followers = $user->followers;

        return response()->json([
            'followers' => $followers
        ], 200);
    }

    public function followings($id)
    {
        $user = User::findOrFail($id);

        $followings = $user->followings;

        return response()->json([
            'followings' => $followings
        ], 200);
    }
}
