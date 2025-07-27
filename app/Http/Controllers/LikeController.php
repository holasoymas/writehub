<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LikeController extends Controller
{
    public function toggleLike(Request $request)
    {
        $validated = $request->validate([
            'likableId' => 'required|integer',
            'likableType' => 'required|string',
        ]);

        Log::info($validated);
        $likableTypeMap = [
            'Post' => Post::class,
            'Comment' => Comment::class,
        ];

        $likableClass = $likableTypeMap[$validated['likableType']];
        $likable = $likableClass::findOrFail($validated['likableId']);

        $existingLike = $likable->likes()->where('user_id', Auth::id())->first();
        Log::info('Is likes' . $existingLike);

        if ($existingLike) {

            $existingLike->delete();

            return response()->json(['liked' => false, 'likesCount' => $likable->likes_count]);
        }

        $likable->likes()->create(['user_id' => Auth::id()]);

        return response()->json(['liked' => true, 'likesCount' => $likable->likes_count]);
    }
}
