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
                    'google_id' => $googleUser->getId(),
                    'imagen' => $googleUser->getAvatar(),
                ]
            );

            Auth::guard('comprador')->login($user);
            if( ($user->nickname == null) || ($user->provincia == null) || ($user->direccion  == null)){
                return redirect()->intended('/comprador/profile')->with('success', 'Por favor termina de rellar tus datos');
            }else{
                return redirect()->intended('/comprador/home')->with('success', 'login exitoso');
            }
            
        } elseif ($userType == 'vendedor') {
            $user = Vendedor::updateOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'nombre' => $googleUser->getName(),
                    'google_id' => $googleUser->getId(),
                    'imagen' => $googleUser->getAvatar(),
                ]
            );

            Auth::guard('vendedor')->login($user);
            if( ($user->nickname == null) || ($user->provincia == null) || ($user->direccion  == null)){
                return redirect()->intended('/vendedor/profile')->with('success', 'Por favor termina de rellar tus datos');
            }else{
                return redirect()->intended('/vendedor/home')->with('success', 'login exitoso');
            }
        }

        return redirect('/login');
    }
}


