<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;




Route::prefix('comprador')->name('comprador.')->group(function () {

    Route::get('/google-auth/redirect', 'App\Http\Controllers\GoogleController@redirectComprador')->name('google-redirect');

    Route::get('/google-auth/callback', 'App\Http\Controllers\GoogleController@callback')->name('google-callback');

    Route::namespace('App\Http\Controllers\comprador')->group(function () {
        Route::middleware(['guest:comprador', 'revalidate'])->group(function () {
            Route::view('/login', 'comprador.auth.login')->name('login');
            Route::post('/login', 'CompradorController@loginHandler')->name('login-handler');


            Route::view('/register', 'comprador.auth.register')->name('register');
            Route::post('/register', 'CompradorController@registerHandler')->name('register-handler');
        });

        Route::middleware(['auth:comprador', 'revalidate'])->group(function () {
            Route::view('/home', 'comprador.home')->name('home');
            Route::post('/logout', 'CompradorController@logoutHandler')->name('logout');

            Route::view('/profile', 'comprador.profile')->name('profile');
            Route::get('/profile/update', 'CompradorProfileController@showProfileUpdate')->name('profile.update');
            Route::post('/profile/update', 'CompradorProfileController@updateProfileHandler')->name('profile.update-handler');

            Route::view('/paymet', 'comprador.payment')->name('payment');
            Route::get('/orders', 'CompradorController@orders')->name('orders');
        });
    });
});
