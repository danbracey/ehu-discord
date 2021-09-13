<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Http;
use Laravel\Socialite\Facades\Socialite;
use RestCord\DiscordClient;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $session = $request->session()->get('user');

        //Check user is logged in
        if(! $session)
        {
            abort(403, "You are not signed in with Discord!");
        }

        $client = new DiscordClient(['token' => env('DISCORD_BOT_TOKEN')]); // Token is required

        //Check user exists in Server
        try {
            $user = $client->guild->getGuildMember([
                'guild.id' => (int)env('DISCORD_GUILD_ID'),
                'user.id' => (int)$session->id
            ]);
        } catch (\Exception $exception)
        {
            abort(500, "We can't sign you in. Are you a member of the EHU Discord Server?");
        }

        return view('home', [
            'User' => $user,
        ]);
    }
}
