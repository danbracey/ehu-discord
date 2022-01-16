<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RestCord\DiscordClient;

class HomeController extends Controller
{
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

        //Check that the course is valid
        $GetDiscordRoles = $client->guild->getGuildRoles([
            'guild.id' => (int)env('DISCORD_GUILD_ID')
        ]);
        $CourseList = array();

        foreach ($GetDiscordRoles as $key => $row) {
            if($row->color == env('COURSE_ROLE_COLOR')) //Light Green Course Roles
            {
                $CourseList[$key] =
                    ["name" => $row->name, "color" => $row->color, "position" => $row->position];
            }

            if($row->color == env('ACCOMMODATION_ROLE_COLOR')) //Yellow accommodation Roles
            {
                $AccommodationList[$key] =
                    ["name" => $row->name, "color" => $row->color, "position" => $row->position];
            }

            if($row->color == env('YEAR_OF_STUDY_ROLE_COLOR')) //Pink year of study Roles
            {
                $YearOfStudyList[$key] =
                    ["name" => $row->name, "color" => $row->color, "position" => $row->position];
            }

            if($row->color == env('MODULE_ROLE_COLOR')) //Pink year of study Roles
            {
                $ModuleList[$row->id] =
                    ["name" => $row->name, "color" => $row->color, "position" => $row->position];
            }
        }

        //Sort all arrays by their role position in Discord
        uasort($CourseList, function ($a, $b) { return $b['position'] - $a['position']; });
        uasort($AccommodationList, function ($a, $b) { return $b['position'] - $a['position']; });
        uasort($YearOfStudyList, function ($a, $b) { return $b['position'] - $a['position']; });
        uasort($ModuleList, function ($a, $b) { return $b['position'] - $a['position']; });

        return view('home', [
            'User' => $user,
            'CourseList' => $CourseList,
            'AccommodationList' => $AccommodationList,
            'YearOfStudyList' => $YearOfStudyList,
            'ModuleList' => $ModuleList
        ]);
    }
}
