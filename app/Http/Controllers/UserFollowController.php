<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserFollowController extends Controller
{
    use AuthorizesRequests;

    public function follow(User $user)
    {
        $this->authorize('follow', $user);

        request()->user()->followings()->attach($user->id);

        return back();
    }

    public function unfollow(User $user)
    {
        $this->authorize('unfollow', $user);

        request()->user()->followings()->detach($user->id);

        return back();
    }
}
