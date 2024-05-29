<?php

namespace App\Http\Controllers;

use App\Models\Comprador;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class indexController extends Controller
{
    public function index(Request $request)
    {

        $comprador = null;
        if (Auth::guard('comprador')->check()) {
            $comprador = Auth::guard('comprador')->user();
        }

        $productos = Producto::all();

        return view('index', compact('productos', 'comprador'));
    }


    public function search(Request $request)
    {

        $productos = Producto::query()
            ->where('nombre', 'LIKE', '%' .  $request->search  . '%')
            ->orWhereHas('categorias', function ($query) use ($request) {
                $query->where('nombre', 'LIKE', '%' . $request->search . '%');
            })
            ->get();

        return view('search', compact('productos'));
    }


    public function producto(Request $request)
    {
        $producto = Producto::with('categorias')->findOrFail($request->id);

        $productosSimilares = Producto::whereHas('categorias', function ($query) use ($producto) {
            $categoriaP = $producto->categorias->pluck('id');
            $query->where('categoria_id', $categoriaP->all());
        })->where('id', '!=', $producto->id)->get();

        return view('producto', compact('producto', 'productosSimilares'));
    }

    public function searchVendedor(Request $request)
    {
       
        $productos = Producto::where('vendedor_id', $request->id)
            ->with('vendedor')
            ->get();

        return view('vendedor-search', compact('productos'));
    }
}
