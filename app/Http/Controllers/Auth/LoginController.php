<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create()
    {
        return view("auth.login");
    }

    public function store(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // regenerate the session id
            $request->session()->regenerate();

            return to_route("user.show", ["user" => Auth::id()]);
        }

        return back()->withErrors([
            'error' => 'Invalid credentials',
        ])->onlyInput('email'); // prepolute email field
    }
}
