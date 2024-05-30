<?php

namespace App\Http\Controllers\vendedor;

use App\Http\Controllers\Controller;
use App\Http\Requests\vendedor\VendedorLoginRequest;
use App\Http\Requests\vendedor\VendedorRegisterRequest;
use App\Models\DetalleTransaccion;
use App\Models\Vendedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendedorController extends Controller
{
    public function loginHandler(VendedorLoginRequest $request)
    {
        $credentials = $request->getCredentials();

        if (Auth::guard('vendedor')->attempt($credentials)) {
            return redirect()->route('vendedor.home');
        }

        return redirect()->route('vendedor.login')->withErrors([
            'login' => 'Estas credenciales no coinciden con nuestros registros.',
        ]);
    }

    public function logoutHandler(Request $request){
        Auth::guard('vendedor')->logout();
        return redirect()->route('vendedor.login');
    }

    public function registerHandler(VendedorRegisterRequest $request){
        $user = Vendedor::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'nickname' => $request->nickname,
            'provincia' => $request->provincia,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'fecha_nac' => $request->fecha_nac,
            'password' => $request->password,
        ]);
        return redirect('/vendedor/login')->with('sucess', 'Cuenta creada correctamente');
    }

    public function showSales(){
        $vendedor = auth()->id();
        
        $transacciones = DetalleTransaccion::with('producto')
        ->where('comprador_id', $vendedor)
        ->get();

        return view('vendedor.sales', compact('transacciones'));
    }
}

