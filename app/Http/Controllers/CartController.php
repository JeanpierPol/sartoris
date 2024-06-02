<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Variante;

class CartController extends Controller
{
    public function addToCar(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);
        $variante_id = $request->input('talla');
        $variante = Variante::findOrFail($variante_id);

        $cart = $request->session()->get('cart', []);

        if ($variante->existencias > 0) {
            if (isset($cart[$variante->id])) {
                $cart[$variante->id]['cantidad']++;
            } else {
                $cart[$variante->id] = [
                    "id_producto" => $producto->id,
                    "nombre" => $producto->nombre,
                    "imagen_portada" => $producto->imagen_portada,
                    "precio_venta" => $variante->precio_venta,
                    "descuento"=> $variante->descuento,
                    "existencias"=> $variante->existencias,
                    "variante" => $variante->talla,
                    "cantidad" => 1
                ];
            }
        } else {
            return redirect()->back()->with('error', 'Variante no válida o sin existencias');
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
