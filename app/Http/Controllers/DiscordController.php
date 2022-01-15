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
            if($course['color'] == env('COURSE_ROLE_COLOR'))
            {
                $UserRoles = $discord->guild->getGuildMember([
                    'guild.id' => (int)env('DISCORD_GUILD_ID'),
                    'user.id' => (int)$request->session()->get('user')->id,
                ]);

                //Remove previous courses
                foreach($OutputDiscordRoles as $key => $value) if ($value['color'] == env('COURSE_ROLE_COLOR'))
                {
                    if(in_array($key, $UserRoles->roles))
                    {
                        $discord->guild->removeGuildMemberRole([
                            'guild.id' => (int)env('DISCORD_GUILD_ID'),
                            'user.id' => (int)$request->session()->get('user')->id,
                            'role.id' => $key
                        ]);
                    }
                }

                $discord->guild->addGuildMemberRole([
                    'guild.id' => (int)env('DISCORD_GUILD_ID'),
                    'user.id' => (int)$request->session()->get('user')->id,
                    'role.id' => $request->course
                ]);
            } else {
                abort(403, "This is not a valid course");
            }
        } else {
            abort(403, "Invalid selection");
        }

        Session::flash('success', 'Your course has been updated successfully');
        return redirect(route('home'));
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
            if($accommodation['color'] == env('ACCOMMODATION_ROLE_COLOR'))
            {
                $UserRoles = $discord->guild->getGuildMember([
                    'guild.id' => (int)env('DISCORD_GUILD_ID'),
                    'user.id' => (int)$request->session()->get('user')->id,
                ]);

                //Remove previous accommodation
                foreach($OutputDiscordRoles as $key => $value) if ($value['color'] == env('ACCOMMODATION_ROLE_COLOR'))
                {
                    if(in_array($key, $UserRoles->roles))
                    {
                        $discord->guild->removeGuildMemberRole([
                            'guild.id' => (int)env('DISCORD_GUILD_ID'),
                            'user.id' => (int)$request->session()->get('user')->id,
                            'role.id' => $key
                        ]);
                    }
                }

                $discord->guild->addGuildMemberRole([
                    'guild.id' => (int)env('DISCORD_GUILD_ID'),
                    'user.id' => (int)$request->session()->get('user')->id,
                    'role.id' => $request->accommodation
                ]);
            } else {
                abort(403, "This role is not valid Accommodation");
            }
        } else {
            abort(403, "Invalid selection");
        }

        Session::flash('success', 'Your accommodation has been updated successfully');
        //Log user out
        return redirect(route('home'));
    }

    public function year(Request $request)
    {
        $discord = new DiscordClient(['token' => env('DISCORD_BOT_TOKEN')]); // Token is required

        //Check that the year is valid
        $GetDiscordRoles = $discord->guild->getGuildRoles([
            'guild.id' => (int)env('DISCORD_GUILD_ID')
        ]);
        $OutputDiscordRoles = array();

        foreach ($GetDiscordRoles as $GDR) {
            $OutputDiscordRoles[$GDR->id] =
                ["name" => $GDR->name, "color" => $GDR->color];
        }

        if(array_key_exists($request->year, $OutputDiscordRoles))
        {
            $year = $OutputDiscordRoles[$request->year];

            //Check the user isn't trying to give themselves admin
            if($year['color'] == env('YEAR_OF_STUDY_ROLE_COLOR'))
            {
                $UserRoles = $discord->guild->getGuildMember([
                    'guild.id' => (int)env('DISCORD_GUILD_ID'),
                    'user.id' => (int)$request->session()->get('user')->id,
                ]);

                //Remove previous years
                foreach($OutputDiscordRoles as $key => $value) if ($value['color'] == env('YEAR_OF_STUDY_ROLE_COLOR'))
                {
                    if(in_array($key, $UserRoles->roles))
                    {
                        $discord->guild->removeGuildMemberRole([
                            'guild.id' => (int)env('DISCORD_GUILD_ID'),
                            'user.id' => (int)$request->session()->get('user')->id,
                            'role.id' => $key
                        ]);
                    }
                }

                $discord->guild->addGuildMemberRole([
                    'guild.id' => (int)env('DISCORD_GUILD_ID'),
                    'user.id' => (int)$request->session()->get('user')->id,
                    'role.id' => $request->year
                ]);
            } else {
                abort(403, "This role is not a valid year of study!");
            }
        } else {
            abort(403, "Invalid selection");
        }

        Session::flash('success', 'Your year of study has been updated successfully');
        //Log user out
        return redirect(route('home'));
    }

    public function module(Request $request)
    {
        $discord = new DiscordClient(['token' => env('DISCORD_BOT_TOKEN')]); // Token is required

        //Check that the module is valid
        $GetDiscordRoles = $discord->guild->getGuildRoles([
            'guild.id' => (int)env('DISCORD_GUILD_ID')
        ]);
        $OutputDiscordRoles = array();

        foreach ($GetDiscordRoles as $GDR) {
            $OutputDiscordRoles[$GDR->id] =
                ["name" => $GDR->name, "color" => $GDR->color];
        }

        //Remove previous module choices
        foreach ($OutputDiscordRoles as $key => $value) if ($value['color'] == env('MODULE_ROLE_COLOR')) {
            $discord->guild->removeGuildMemberRole([
                'guild.id' => (int)env('DISCORD_GUILD_ID'),
                'user.id' => (int)$request->session()->get('user')->id,
                'role.id' => $key
            ]);
        }

        if($request->module_choice) {
            foreach ($request->module_choice as $module_choice) {
                if (array_key_exists($module_choice, $OutputDiscordRoles)) {
                    $module = $OutputDiscordRoles[$module_choice];

                    //Check the user isn't trying to give themselves admin
                    if ($module['color'] == env('MODULE_ROLE_COLOR')) {
                        $discord->guild->addGuildMemberRole([
                            'guild.id' => (int)env('DISCORD_GUILD_ID'),
                            'user.id' => (int)$request->session()->get('user')->id,
                            'role.id' => $module_choice
                        ]);
                    } else {
                        abort(403, "This role is not a valid optional module choice!");
                    }
                } else {
                    abort(403, "Invalid selection");
                }
            }
        } else {
            return back()->with('danger', 'No optional modules selected, any previous optional modules have been removed!');
        }

        Session::flash('success', 'Your optional module choices have been updated successfully');
        //Log user out
        return redirect(route('home'));
    }
}
