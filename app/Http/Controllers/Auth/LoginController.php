<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function username()
    {
        return 'id'; //Use Discord ID instead of Username
    }

    public function redirectToProvider()
    {
        return Socialite::driver('discord')
            ->setScopes(['identify']) //Overwrite scopes to ensure minimal scope access - Privacy
            ->redirect();
    }

    public function handleProviderCallback()
    {
        try{
            $discord = Socialite::driver('discord')->user();
            session(['user' => $discord]);

            return redirect('/home');
        }
        catch(\Exception $exception)
        {
            abort(500, "It looks like we couldn't sign you in. Please ensure you're in our discord server! Full error details:" . $exception);
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

}
