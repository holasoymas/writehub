<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\Tag;
use Illuminate\Routing\Controller;
use App\Models\User;
use Cloudinary\Cloudinary;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;

class UserController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("welcome");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("user.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $validatedUser = $request->validated();

        if ($request->hasFile('user_pic')) {

            $cloudinary = new Cloudinary();

            $upload = $cloudinary->uploadApi()->upload(

                $request->file('user_pic')->getRealPath(),

                ['folder' => 'user_profiles'] // folder in cloudinary

            );

            $validatedUser['profile_pic'] = $upload['secure_url'];
            // $validatedUser['public_id'] =  $upload['public_id'];
        }

        // $user = $request->all();
        $create = User::create($validatedUser);

        Auth::login($create);

        return to_route("user.show", ["user" => $create->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user = User::with([
            'posts.tags',
            'posts' => function ($query) {
                $query->withCount(['likes', 'comments']);
            }
        ])
            ->withCount(['followers', 'followings'])
            ->find($user->id);

        $recommendedTags = (new Tag())->getRecommendedTags($user, 5);

        return view("user.show", compact("user", "recommendedTags"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);

        return view("user.edit", compact("user"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validatedUser = $request->validate([
            'name' => 'required|string|min:3|max:20',
            'bio' => 'max:50',
            'profile_pic' => [File::image()->max('1mb')]
        ]);

        if ($request->hasFile('profile_pic')) {

            $cloudinary = new Cloudinary();

            $upload = $cloudinary->uploadApi()->upload(

                $request->file('profile_pic')->getRealPath(),

                ['folder' => 'user_profiles'] // folder in cloudinary
            );

            $validatedUser['profile_pic'] = $upload['secure_url'];
        }

        $user->update($validatedUser);

        return to_route("user.show", ["user" => $user->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
