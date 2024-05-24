<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class CartController extends Controller
{
    public function addToCar(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);
        $cart = $request->session()->get('cart', []);

        if (isset($cart[$producto->id])) {
            $cart[$producto->id]['cantidad']++;
        } else {
            $cart[$producto->id] = [
                "nombre" => $producto->nombre,
                "cantidad" => ($request->cantidad) ? $request->cantidad : 1,
                "precio_venta" => $producto->precio_venta,
                "descuento" => $producto->descuento,
                "imagen_portada" => $producto->imagen_portada
            ];
        }

        $request->session()->put('cart', $cart);
        return redirect()->back()->with('success', 'El producto ha sido agregado');
    }

    public function productosCart(Request $request)
    {
        return view('cart');
    }

    public function destroy(Request $request, $id)
    {
        $cart = $request->session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            $request->session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Producto eliminado con éxito de su carrito.');
        }

        return redirect()->back()->with('error', 'Producto no encontrado en el carrito.');
    }
}
