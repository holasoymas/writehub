<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function toggleBookMark(Request $request)
    {
        $user = Auth::user();

        $post = Post::findOrFail($request->postId);


        $result = $post->bookmarkedUsers()->toggle($user->id);
        // toggle returns arrays: ['attached' => [...], 'detached' => [...]]

        if (!empty($result['attached'])) {
            return response()->json(['bookmarked' => true]);
        }

        if (!empty($result['detached'])) {
            return response()->json(['bookmarked' => false]);
        }

        return response()->json(['status' => 'error'], 400);
    }
}
