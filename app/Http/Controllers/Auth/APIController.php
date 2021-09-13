<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class APIController extends Controller
{
    public function index() {
        $APIKey = User::where('user', Auth::user()->id)->get();
        $APIKey = $APIKey->api_key;


    }
}
