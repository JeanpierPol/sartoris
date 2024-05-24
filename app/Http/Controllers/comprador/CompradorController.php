<?php

namespace App\Http\Controllers\comprador;

use App\Http\Controllers\Controller;
use App\Http\Requests\comprador\CompradorLoginRequest;
use App\Http\Requests\comprador\CompradorRegisterRequest;
use App\Models\Comprador;
use Illuminate\Support\Facades\Auth;


class CompradorController extends Controller
{
    public function loginHandler(CompradorLoginRequest $request)
    {
        $credentials = $request->getCredentials();

        if (Auth::guard('comprador')->attempt($credentials)) {
            return redirect()->back()->with('succes', 'login');
        }

        return redirect()->route('comprador.login')->withErrors([
            'login' => 'Estas credenciales no coinciden con nuestros registros.',
        ]);
    }

    public function logoutHandler(){
        Auth::guard('comprador')->logout();
        return redirect()->route('comprador.login');
    }


    public function registerHandler(CompradorRegisterRequest $request){
        $user = Comprador::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'nickname' => $request->nickname,
            'pais' => $request->pais,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'fecha_nac' => $request->fecha_nac,
            'password' => $request->password,
        ]);
        return redirect('/comprador/login')->with('sucess', 'Cuenta creada correctamente');
    }

}
