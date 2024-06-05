<?php

namespace App\Http\Controllers;

use App\Models\Comprador;
use App\Models\Producto;
use App\Models\Vendedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class indexController extends Controller
{
    /**
     * Página de inicio
     */
    public function index(Request $request)
    {

        $comprador = null;
        if (Auth::guard('comprador')->check()) {
            $comprador = Auth::guard('comprador')->user();
        }

        $productos = Producto::with('variantes')->get();

        return view('index', compact('productos', 'comprador'));
    }
    /**
     * Buscador
     */

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

    /**
     * Página un producto en especifico 
     */

    public function producto(Request $request)
    {
        $producto = Producto::with('categorias')->findOrFail($request->id);

        $productosSimilares = Producto::with('variantes')->whereHas('categorias', function ($query) use ($producto) {
            $categoriaP = $producto->categorias->pluck('id');
            $query->where('categoria_id', $categoriaP->all());
        })->where('id', '!=', $producto->id)->get();

        return view('producto', compact('producto', 'productosSimilares'));
    }

    /**
     * Página que muestra todos los productos asociados a un comprador 
     */

    public function searchVendedor(Request $request)
    {
        $vendedor = Vendedor::findOrfail($request->id);
        $productos = Producto::where('vendedor_id', $request->id)
            ->with('vendedor')
            ->get();
        
        return view('vendedor-search', compact('productos', 'vendedor'));
    }
}
