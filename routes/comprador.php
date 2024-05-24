<?php

use Illuminate\Support\Facades\Route;

Route::prefix('comprador')->name('comprador.')->group(function () {
    Route::namespace('App\Http\Controllers\comprador')->group(function () {
        Route::middleware(['guest:comprador', 'revalidate'])->group(function () {
            Route::view('/login', 'comprador.auth.login')->name('login');
            Route::post('/login', 'compradorController@loginHandler')->name('login-handler');

            Route::view('/register', 'comprador.auth.register')->name('register');
            Route::post('/register', 'compradorController@registerHandler')->name('register-handler');
        });

        Route::middleware(['auth:comprador', 'revalidate'])->group(function () {
            Route::view('/home', 'comprador.home')->name('home');
            Route::post('/logout', 'compradorController@logoutHandler')->name('logout');

            Route::view('/profile', 'comprador.profile')->name('profile');
            Route::get('/profile/update', 'compradorProfileController@showProfileUpdate')->name('profile.update');
            Route::post('/profile/update', 'compradorProfileController@updateProfileHandler')->name('profile.update-handler');

        });
    });
});
