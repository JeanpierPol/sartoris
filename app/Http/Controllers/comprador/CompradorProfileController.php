<?php

namespace App\Http\Controllers\comprador;

use App\Http\Controllers\Controller;
use App\Http\Requests\comprador\CompradorUpdateRequest;
use App\Models\Comprador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CompradorProfileController extends Controller
{
    public function showProfileUpdate()
    {
        $comprador = null;
        if (Auth::guard('comprador')->check()) {
            $comprador = Comprador::findOrFail(auth()->id());
        }
        return view('comprador.auth.update', compact('comprador'));
    }

    public function updateProfileHandler(CompradorUpdateRequest $request)
    {
        $user = Auth::guard('comprador')->user();
        
        if ($request->hasFile('imagen')) {
            $imagen = $request->imagen;
            $imagenName = $user->id . "_profile.png";
            $imagen->move(public_path('img/usuarios/comprador'), $imagenName);
            $path = "/img/usuarios/comprador/" . $imagenName;
            $user->imagen = $path;
        }
        $user->nombre = $request->nombre;
        $user->apellido = $request->apellido;
        $user->provincia = $request->provincia;
        $user->direccion = $request->direccion;
        $user->email = $request->email;
        $user->nickname = $request->nickname;
        $user->telefono = $request->telefono;
        $user->fecha_nac = $request->fecha_nac;
        $user->save();

        return redirect('comprador/profile')->with('success', 'Cuenta actualizada');;
        
    }
}
