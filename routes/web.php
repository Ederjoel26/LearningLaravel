<?php

use App\Http\Controllers\RelationController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', function (){
    return view('welcome');
});
 
Route::get('/login-google', function () {
    return Socialite::driver('google')->redirect();
})->name('login');

Route::get('home', function(){
    return view('home');
})->name('home');
 
Route::post("/Insert", 'App\Http\Controllers\ConsumeController@InsertProduct');

Route::get('/google-callback', function () {
    $user = Socialite::driver('google')->user();
    userExist($user, 'google');

    return view("welcome");
})->name('googlecallback');

Route::get('/login-facebook', function(){
    return Socialite::driver('facebook')->redirect();
})->name('facebookcallback');

Route::get('/facebook-callback', function(){
    $user = Socialite::driver('facebook')->user();
    userExist($user, 'facebook');

    return view("welcome");
});

function userExist($user, $platform){
    $userExist = User::where('external_id', $user->id)->where('external_auth', $platform)->first();
    if($userExist){
        Auth::login($userExist);
    }else{
        $userNew = User::create([
            'name' => $user->name,
            'email' => $user->email,
            'avatar' => $user->avatar,
            'external_id' => $user->id,
            'external_auth' => $platform,
        ]);
        Auth::login($userNew);
    }
}