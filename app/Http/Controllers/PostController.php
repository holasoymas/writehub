<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        // $request->validate([
        //     'image' => 'image|max:2mb',
        // ]);

        if ($request->hasFile('image')) {
            return response()->json([
                'success' => 1,
                'file' => [
                    'url' => "https://imgs.search.brave.com/CgKD821br3UO1oO9Mwqi9TGgCklQfqoa5DfM0E0xTiE/rs:fit:500:0:1:0/g:ce/aHR0cHM6Ly91cGxv/YWQud2lraW1lZGlh/Lm9yZy93aWtpcGVk/aWEvY29tbW9ucy9i/L2I2L1BlbmNpbF9k/cmF3aW5nX29mX2Ff/Z2lybF9pbl9lY3N0/YXN5LmpwZw"
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
        return response(['msg' => 'Data send'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
}
