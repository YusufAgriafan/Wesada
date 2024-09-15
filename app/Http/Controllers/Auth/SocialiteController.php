<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SocialiteController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $socialUser = Socialite::driver('google')->stateless()->user();

        $registeredUser = User::where('email', $socialUser->email)->first();

        if ($registeredUser) {
            $registeredUser->update([
                'name' => $socialUser->name,
                'remember_token' => $socialUser->token,
            ]);

            Auth::login($registeredUser);
        } else {
            $user = User::create([
                'name' => $socialUser->name,
                'email' => $socialUser->email,
                'password' => Hash::make(Str::random(16)),  // Set random password
                'remember_token' => $socialUser->token,
                'email_verified_at' => now(),
                'role' => 'user',
                // 'google_refresh_token' => $socialUser->refreshToken,  // Uncomment jika diperlukan
            ]);

            Auth::login($user);
        }

        return redirect('/');
    }

}
