<?php

namespace App\Http\Controllers;

use App\Actions\Auth\SocialiteAuth;
use Laravel\Socialite\Facades\Socialite;
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
        SocialiteAuth::callback('google');

        return redirect()->intended('home');
    }
}

