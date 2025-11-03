<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    // for form forget password
    public function showForgotForm()
    {
        return view("auth.forgot-password");
    }

    // for sending verification link to email
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request["email"])->first();

        if (!$user) {
            return back()->withErrors(['error' => 'The provided email is not registered on Writehub']);
        }
        // send reset link to the email
        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::ResetLinkSent
            ? redirect()
            ->route("password.email.send")
            ->with(["email" => $request->email])
            : back()->withErrors(['email' => __($status)]);
    }

    // for displaying password fields to type new password
    public function showResetForm(string $token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    // for changing password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'email|required',
            'password' => 'required|min:6|confirmed'
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));


                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PasswordReset
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    public function showSuccessReset()
    {
        return view("auth.reset-password-success");
    }
}
