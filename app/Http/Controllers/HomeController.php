<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

        //Get Course Roles
        //Check that the course is valid
        $GetDiscordRoles = $client->guild->getGuildRoles([
            'guild.id' => (int)env('DISCORD_GUILD_ID')
        ]);
        $CourseList = array();

        foreach ($GetDiscordRoles as $GDR) {
            if($GDR->color == env('COURSE_ROLE_COLOR')) //Light Green Course Roles
            {
                $CourseList[$GDR->id] =
                    ["name" => $GDR->name, "color" => $GDR->color];
            }

            if($GDR->color == env('ACCOMMODATION_ROLE_COLOR')) //Yellow accommodation Roles
            {
                $AccommodationList[$GDR->id] =
                    ["name" => $GDR->name, "color" => $GDR->color];
            }
        }

        return view('home', [
            'User' => $user,
            'CourseList' => $CourseList,
            'AccommodationList' => $AccommodationList
        ]);
    }
}
