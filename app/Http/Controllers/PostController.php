<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Cloudinary\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function uploadImage(Request $request)
    {
        Log::info($request->all());
        $request->validate([
            'image' => [File::image()->max('2mb')],
        ]);

        if ($request->hasFile('image')) {

            $cloudinary = new Cloudinary();

            $upload = $cloudinary->uploadApi()->upload(

                $request->file('image')->getRealPath(),

                ['folder' => 'post_images']
            );

            return response()->json([
                'success' => 1,
                'file' => [
                    'url' => $upload['secure_url'],
                    'public_id' => $upload['public_id'],
                ]
            ]);
        }
    }

    public function ploadImageUrl(Request $request)
    {
        Log::info($request->all());
        // $request->validate([
        //     'image' => 'image|max:2mb',
        // ]);

        return response()->json([
            'success' => 1,
            'file' => [
                'url' => "https://imgs.search.brave.com/YGK_sUKxIzP7AxNaS5smv_6pe0nL5kgZLmCkG698ftg/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9jdXN0/b21lcnNjYW52YXMu/Y29tL2hlbHAvZGVz/aWduZXJzLW1hbnVh/bC9hZG9iZS9pbmRl/c2lnbi9ob3ctdG8t/Y3JlYXRlLWRlc2ln/bnMvaW1hZ2VzL2lt/YWdlLXN0dWItcGxh/Y2Vob2xkZXIucG5n"
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return response('clreate page come');
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $content = $request->all();

        $tags = $content["tags"];
        // strip_tags remove the html tags
        $header = strip_tags($content["content"]["blocks"][0]["data"]["text"]);
        Log::info($header);
        Log::info($content["content"]["blocks"]);
        Log::info(json_encode($content["content"]["blocks"]));

        $post = new Post();
        $post->user_id = Auth::id();
        $post->title = $header;
        $post->content = json_encode($content["content"]["blocks"]);
        $post->slug = Str::slug($header);
        $post->save();

        $tagIds = [];
        foreach ($tags as $tag) {
            $tag = \App\Models\Tag::firstOrCreate(['name' => $tag]);
            $tagIds[] = $tag->id;
        }

        // for attaching tags and detaching old ones
        $post->tags()->sync($tagIds);

        return response()->json([
            'redirect_url' => route('posts.show', ['slug' => $post->slug]),
            'message' => 'Post created successfully!'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        /*-----------------------
        * this method fetch all the comments , comments with reply also
        * and reply as a top level also requesting redundent data
        ------------------------
        */
        // $post = Post::with('user', 'comments.recursiveReplies')->where('slug', $slug)->firstOrFail();

        // ----------------------------------------------------------------------------------------------

        /*
         ------------------------------------------------
        // optimized query only fetch top level comments and their replies in recursive
        ------------------------------------------------
        */
        $post = Post::with([
            'user',
            'likes',
            'tags',
            'comments' => function ($q) {
                $q->whereNull('parent_id')->with([
                    'likes',                   // eager load likes on top-level comments
                    'recursiveReplies.likes'  // eager load likes on replies recursively
                ]);
            }
        ])
            ->withCount('comments')
            ->where('slug', $slug)
            ->firstOrFail();

        Log::info($post);
        $post->content = json_decode($post->content); // object (or use `true` for array)

        $authUser = Auth::user();
        $authUserId = Auth::id();

        // Enrich posts with likes (compute using prepolute data to avoid lazy fetching)
        $post->is_liked = $post->likes->contains('user_id', $authUserId);
        $post->likes_count = $post->likes->count();

        // Enrich comments recursively
        foreach ($post->comments as $comment) {
            $this->attachLikeMeta($comment);
        }

        return view('posts.show', compact("post"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    private function attachLikeMeta($comment)
    {
        $userId = Auth::id();

        $comment->is_liked = $comment->likes->contains('user_id', $userId);
        $comment->likes_count = $comment->likes->count();

        if ($comment->relationLoaded('recursiveReplies')) {
            foreach ($comment->recursiveReplies as $reply) {
                $this->attachLikeMeta($reply);
            }
        }
    }
}
