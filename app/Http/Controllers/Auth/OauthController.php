<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class OauthController extends Controller
{
    /**
     * Redirect to OAuth provider
     */
    public function redirect($provider)
    {
        if (!in_array($provider, ['google', 'facebook', 'github'])) {
            abort(404);
        }

        return Socialite::driver($provider)->redirect();
    }

    // handle oauth callback
    public function callback($provider)
    {
        try {
            // get the user of the provider
            $socialUser = Socialite::driver($provider)->user();

            $user = User::where('email', $socialUser->email)->first();

            // if there is a user , it means that the user is previously logged in so just change the oauth proviers not password
            if ($user) {
                $user->update([
                    'provider' => $provider,
                    'provider_id' => $socialUser->getId(),
                    'provider_token' => $socialUser->provider_token,
                    'provider_refresh_token' => $socialUser->refreshToken ?? null,
                    'profile_pic' => $socialUser->getAvatar(),
                ]);
            } else {
                // if user is not found earlier it mean the oauth user is fresh so create it
                $user =  User::create([
                    'name' => $socialUser->getName(),
                    'email' => $socialUser->getEmail(),
                    'profile_pic' => $socialUser->getAvatar(),
                    'provider' => $provider,
                    'provider_id' => $socialUser->getId(),
                    'provider_token' => $socialUser->provider_token,
                    'provider_refresh_token' => $socialUser->refreshToken ?? null,
                    'password' => Hash::make(Str::random(32)),
                    'email_verefied_at' => now(),
                ]);
            }

            Auth::login($user);

            return to_route('user.show', Auth::id(), 201);
        } catch (\Exception $e) {
            return redirect('/')->withErrors(['error', 'OAuth failed. Check logs.']);
        }
    }
}
