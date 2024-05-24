<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\DetalleTransaccion;
use App\Models\Producto;

class TransaccionController extends Controller
{
    public function success()
    {
        $productos = session('cart');
        $comprador = null;

        if (Auth::guard('comprador')->check()) {
            $comprador = Auth::guard('comprador')->user();
        }
        DB::beginTransaction();

        try {
            $total = 0;

            foreach ($productos as $id => $productoData) {
                $producto = Producto::find($id);
                
                if ($producto) {
                    $cantidad = $productoData['cantidad'];
                    $precioUnitario = $producto->precio_venta;
                    $subtotal = $cantidad * $precioUnitario;
                    
                    $detalleTransaccion = new DetalleTransaccion([
                        'comprador_id' => $comprador->id,
                        'producto_id' => $producto->id,
                        'cantidad' => $cantidad,
                        'precio_unitario' => $precioUnitario,
                        'subtotal' => $subtotal,
                        'fecha' => now(),
                    ]);
                    $detalleTransaccion->save();

                    $producto->existencias -= $cantidad;
                    $producto->save();

                    $total += $subtotal;
                }
            }

            DB::commit();

            session()->forget('cart');

            return redirect()->route('comprador.home')->with('success', 'Transacción completada exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('cart')->with('error', 'Error al procesar la transacción.');
        }
    }
}
