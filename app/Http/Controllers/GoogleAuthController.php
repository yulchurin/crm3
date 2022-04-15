<?php

namespace App\Http\Controllers;

use App\Common\Interfaces\StudentRole;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Exception;
use Symfony\Component\HttpFoundation\RedirectResponse;

class GoogleAuthController extends Controller
{
    /**
     * Redirects to Google OAuth when user is not authenticated
     *
     * @return RedirectResponse
     */
    public function redirect(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Gets callback from Google then makes a decision whether to authenticate user
     */
    public function callback(): \Illuminate\Http\RedirectResponse
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $user = User::where('email', $googleUser->email)->first();

            if ($user) {
                Auth::login($user);
            } else {
                $newUser = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => Hash::make(Str::random(10)),
                    'profile_photo_path' => $googleUser->getAvatar(),
                    'role' => StudentRole::ENROLLEE,
                ]);
                Auth::login($newUser);
            }

            if (!$user && !$newUser) {
                $email = $googleUser->getEmail();
                throw new Exception("$email login error", 500);
            }

        } catch (Exception $e) {
            if ($e->getCode() !== 0) {
                Log::channel('auth')->error($googleUser?->getId() .': '. $e->getMessage());
            }
        }

        return redirect()->intended('home');
    }
}

