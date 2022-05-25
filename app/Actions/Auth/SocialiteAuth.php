<?php

namespace App\Actions\Auth;

use App\Common\Interfaces\StudentRole;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialiteAuth
{
    public static function callback(string $driver): void
    {
        $socialNetUser = Socialite::driver($driver)->user();

        $email = $socialNetUser->getEmail();

        if ($driver === 'vkontakte') {
            $email = $socialNetUser->getId() . '@vk.com';
        }

        $user = User::firstOrCreate([
            'email' => $email
        ], [
            'name' => $socialNetUser->getName(),
            'email' => $email,
            'socialite_id' => $socialNetUser->getId(),
            'password' => Hash::make(Str::random(10)),
            'profile_photo_path' => $socialNetUser->getAvatar(),
            'role' => StudentRole::ENROLLEE,
        ]);

        Auth::login($user);
    }
}
