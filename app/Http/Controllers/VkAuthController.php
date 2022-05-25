<?php

namespace App\Http\Controllers;

use App\Actions\Auth\SocialiteAuth;
use App\Common\Interfaces\StudentRole;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Exception;
use Symfony\Component\HttpFoundation\RedirectResponse;

class VkAuthController extends Controller
{
    /**
     * Redirects to VK OAuth when user is not authenticated
     *
     * @return RedirectResponse
     */
    public function redirect(): RedirectResponse
    {
        return Socialite::driver('vkontakte')->redirect();
    }

    /**
     * Gets callback from VK then makes a decision whether to authenticate user
     */
    public function callback(): \Illuminate\Http\RedirectResponse
    {
        SocialiteAuth::callback('vkontakte');

        return redirect()->intended('home');
    }
}

