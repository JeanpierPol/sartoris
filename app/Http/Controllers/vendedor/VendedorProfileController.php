<?php

namespace App\Http\Controllers\vendedor;

use App\Http\Controllers\Controller;
use App\Http\Requests\vendedor\VendedorUpdateRequest;
use App\Models\Vendedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendedorProfileController extends Controller
{
    public function showProfileUpdate()
    {
        $vendedor = null;
        if (Auth::guard('vendedor')->check()) {
            $vendedor = Vendedor::findOrFail(auth()->id());
        }
        return view('vendedor.auth.update', compact('vendedor'));
    }

    public function updateProfileHandler(VendedorUpdateRequest $request)
    {
        $user = Auth::guard('vendedor')->user();
        
        if ($request->hasFile('imagen')) {
            $imagen = $request->imagen;
            $imagenName = $user->id . "_profile.png";
            $imagen->move(public_path('img/usuarios/vendedor'), $imagenName);
            $path = "/img/usuarios/vendedor/" . $imagenName;
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

        return redirect('vendedor/profile')->with('success', 'Cuenta actualizada');
    }
}
