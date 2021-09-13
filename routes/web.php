<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\SocialiteController;

Route::get('/', function () {return view('index');})->name('index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('login/discord', 'Auth\LoginController@redirectToProvider')->name('login.discord');
Route::get('login/discord/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('logout', function () {session()->forget('user'); return view('index');})->name('logout');


Route::post('/course', 'DiscordController@course')->name('course');
Route::post('/accommodation', 'DiscordController@accommodation')->name('accommodation');
