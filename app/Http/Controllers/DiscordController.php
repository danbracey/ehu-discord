<?php

namespace App\Http\Controllers;

use App\Jobs\DisableUser;
use App\Role;
use App\role_user;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use RestCord\DiscordClient;

class DiscordController extends Controller
{
    public function course(Request $request)
    {
        $discord = new DiscordClient(['token' => env('DISCORD_BOT_TOKEN')]); // Token is required

        //Check that the course is valid
        $GetDiscordRoles = $discord->guild->getGuildRoles([
            'guild.id' => (int)env('DISCORD_GUILD_ID')
        ]);
        $OutputDiscordRoles = array();

        foreach ($GetDiscordRoles as $GDR) {
            $OutputDiscordRoles[$GDR->id] =
                ["name" => $GDR->name, "color" => $GDR->color];
        }

        if(array_key_exists($request->course, $OutputDiscordRoles))
        {
            $course = $OutputDiscordRoles[$request->course];

            //Check the user isn't trying to give themselves admin
            if($course['color'] == 0)
            {
                $discord->guild->addGuildMemberRole([
                    'guild.id' => (int)env('DISCORD_GUILD_ID'),
                    'user.id' =>  (int)$request->session()->get('user')->id,
                    'role.id' => $request->course
                ]);
            } else {
                abort(403, "Nice try, but I'm not giving you admin lololol");
            }
        } else {
            dd("This role isn't valid");
        }

        Session::flash('success', 'Your course has been updated successfully');
        //Log user out
        return redirect(route('logout'));
    }

    public function accommodation(Request $request)
    {
        $discord = new DiscordClient(['token' => env('DISCORD_BOT_TOKEN')]); // Token is required

        //Check that the course is valid
        $GetDiscordRoles = $discord->guild->getGuildRoles([
            'guild.id' => (int)env('DISCORD_GUILD_ID')
        ]);
        $OutputDiscordRoles = array();

        foreach ($GetDiscordRoles as $GDR) {
            $OutputDiscordRoles[$GDR->id] =
                ["name" => $GDR->name, "color" => $GDR->color];
        }

        if(array_key_exists($request->accommodation, $OutputDiscordRoles))
        {
            $accommodation = $OutputDiscordRoles[$request->accommodation];

            //Check the user isn't trying to give themselves admin
            if($accommodation['color'] == 0)
            {
                $discord->guild->addGuildMemberRole([
                    'guild.id' => (int)env('DISCORD_GUILD_ID'),
                    'user.id' =>  (int)$request->session()->get('user')->id,
                    'role.id' => $request->accommodation
                ]);
            } else {
                abort(403, "Nice try, but I'm not giving you admin lololol");
            }
        } else {
            dd("This role isn't valid");
        }

        Session::flash('success', 'Your accommodation has been updated successfully');
        //Log user out
        return redirect(route('logout'));
    }
}
