<?php

namespace App\Http\Controllers;

use App\Inactivity;
use App\Infraction;
use App\Role;
use App\UserSocial;
use App\XPLevels;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function search(Request $request) {
        $Roles = Role::orderBy('position', 'asc')
            ->whereNotIn('hex', ['979c9f']) //Don't get default colour roles, these are just permission groups
            ->get();

        //Send an empty variable to the view, unless the if logic below changes, then it'll send a proper variable to the view.
        $results = null;

        //Runs only if the search has something in it.
        if (!empty($request->title)) {
            $results = User::where('name', 'like', '%' . $request->title . '%')
                ->orWhere('id', $request->title)
                ->orWhere('discriminator', $request->title)
                ->get();
        }

        //Run search on Roles
        if (!empty($request->roles)) {
            $q = $request->roles;
            $results = User::whereHas('roles', function ($query) use ($q) {
                $query->where('id', $q);
            })->get();
        }

        return view('users.index', [
            'results' => $results,
            'request' => $request,
            'Roles' => $Roles
        ]);
    }

    public function SpecifiedUser($username)
    {
        if ( filter_var($username, FILTER_VALIDATE_INT) == true ) {
            $UserDetails = User::findOrFail($username); //If int provided, search user by their ID
        } else {
            $UserDetails = User::where('name', $username)->firstOrFail();
        }

        $UserSocials = UserSocial::where('uid', $UserDetails->id)->first();
        $UserInfractions = Infraction::where('uid',$UserDetails->id)->get();
        $GetLatestInfraction = Infraction::where('uid',$UserDetails->id)->orderBy('updated_at', 'DESC')->first();
        $ActiveInactivity = Inactivity::where('uid',$UserDetails->id)->where('starts_at', '<=', Carbon::today())->where('ends_at', '>=', Carbon::today())->first();

        return view('users.profile', [
            'UserDetails' => $UserDetails,
            'UserSocials' => $UserSocials,
            'UserInfractions' => $UserInfractions,
            'ActiveInactivity' => $ActiveInactivity,
            'GetLatestInfraction' => $GetLatestInfraction
        ]);
    }

    public function LoggedInUser() {
        $UserDetails = User::where('id', Auth::user()->id)->firstOrFail();
        $UserSocials = UserSocial::where('uid', $UserDetails->id)->first();
        $UserInfractions = Infraction::where('uid',$UserDetails->id)->get();
        $GetLatestInfraction = Infraction::where('uid',$UserDetails->id)->orderBy('updated_at', 'DESC')->first();
        $ActiveInactivity = Inactivity::where('uid',$UserDetails->id)->where('starts_at', '<=', Carbon::today())->where('ends_at', '>=', Carbon::today())->first();
        $GetNextXPLevel = XPLevels::where('required_xp', '>=' , $UserDetails->XP()->sum('points'))->first();

        return view('users.profile', [
            'UserDetails' => $UserDetails,
            'UserSocials' => $UserSocials,
            'GetNextXPLevel' => $GetNextXPLevel,
            'UserInfractions' => $UserInfractions,
            'ActiveInactivity' => $ActiveInactivity,
            'GetLatestInfraction' => $GetLatestInfraction
        ]);
    }

    public function store($id) {
        //Validate the User Input

        $user = User::find($id);
        $user->about = clean(request('about'));
        $user->save();

        return redirect('/user/'.$id);
    }

    public function StoreUserNotes($id) {
        //Validate the User Input

        $user = User::find($id);
        $user->UserNotes = clean(request('UserNotes'));
        $user->save();

        return redirect('/user/'.$id);
    }

    public function ChangeUserTheme($id) {
        $user = User::find(Auth::user()->id);

        switch($id){
            case 0:
                $user->theme = 0; //Dark
                break;
            case 1:
                $user->theme = 1; //Light
                break;
            case 2:
                $user->theme = 2; //Circuit Breaker
                break;
            default:
                $user->theme = 1;
        }

        $user->save();

        return redirect('/');
    }
}
