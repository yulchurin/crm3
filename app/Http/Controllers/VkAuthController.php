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
        try {
            $vkUser = Socialite::driver('vkontakte')->user();

            $user = User::where('vk_id', $vkUser->id)->first();

            if ($user) {
                Auth::login($user);
            } else {
                $dummyEmail = $vkUser->getNickname()
                    ? $vkUser->getNickname() . '@vk.com'
                    : $vkUser->getId() . '@vk.com';

                $newUser = User::create([
                    'name' => $vkUser->getName(),
                    'email' => $vkUser->getEmail() ?? $dummyEmail,
                    'vk_id' => $vkUser->getId(),
                    'password' => Hash::make(Str::random(10)),
                    'profile_photo_path' => $vkUser->getAvatar(),
                    'role' => StudentRole::ENROLLEE,
                ]);
                Auth::login($newUser);
            }

            if (!$user && !$newUser) {
                throw new Exception("$dummyEmail login error", 500);
            }

        } catch (Exception $e) {
            if ($e->getCode() !== 0) {
                Log::channel('auth')->error($vkUser?->getId() .': '. $e->getMessage());
            }
        }

        return redirect()->intended('home');
    }
}

