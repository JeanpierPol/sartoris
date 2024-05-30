<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Comprador;
use App\Models\Vendedor;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function redirectComprador()
    {
        session(['user_type' => 'comprador']);
        return Socialite::driver('google')->redirect();
    }

    public function redirectVendedor()
    {
        session(['user_type' => 'vendedor']);
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();
        $userType = session('user_type');

        if ($userType == 'comprador') {
            $user = Comprador::updateOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'nombre' => $googleUser->getName(),
                    'nickname' => $googleUser->getNickname(),
                    'google_id' => $googleUser->getId(),
                    'imagen' => $googleUser->getAvatar(),
                ]
            );

            Auth::guard('comprador')->login($user);
            return redirect()->intended('/comprador/home');
        } elseif ($userType == 'vendedor') {
            $user = Vendedor::updateOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'nombre' => $googleUser->getName(),
                    'nickname' => $googleUser->getNickname(),
                    'google_id' => $googleUser->getId(),
                    'imagen' => $googleUser->getAvatar(),
                ]
            );

            Auth::guard('vendedor')->login($user);
            return redirect()->intended('/vendedor/home');
        }

        return redirect('/login');
    }
}


