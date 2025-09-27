<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = trim($request->input('q'));

        $blogs = Post::where('title', 'LIKE', '%' . $query . '%')
            ->take(10)
            ->get();

        return response()->json($blogs);
    }
}
