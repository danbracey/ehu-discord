<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function login()
    {
        return Socialite::driver('discord')
            ->setScopes(['identify', 'guilds'])
            ->redirect();
    }

    public function callback()
    {
        $user = Socialite::driver('discord')->user();
        return redirect()->route('home');
    }
}
