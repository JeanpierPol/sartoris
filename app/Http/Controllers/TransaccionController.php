<?php

namespace App\Http\Controllers;

use App\Mail\NotificacionPagoMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\DetalleTransaccion;
use App\Models\Producto;
use App\Models\Variante;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class TransaccionController extends Controller
{
    /**
     * Método para guardar en la bases de datos la transacción
     */
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
                $producto = Producto::find($productoData['id_producto']);
                $variante = Variante::find($id);
                
                if ($producto) {
                    if ($variante->existencias > 0) {
                       
                        $cantidad = $productoData['cantidad'];
                           
                        $precioUnitario = $variante->precio_venta - ($variante->precio_venta * ($variante->descuento / 100));
                        $subtotal = $cantidad * $precioUnitario;

                        $detalleTransaccion = new DetalleTransaccion([
                            'comprador_id' => $comprador->id,
                            'producto_id' => $productoData['id_producto'],
                            'cantidad' => $cantidad,
                            'precio_unitario' => $precioUnitario,
                            'subtotal' => $subtotal,
                            'fecha' => Carbon::now(),
                        ]);
                        $detalleTransaccion->save();

                        $variante->existencias -= $cantidad;
                        $variante->save();
                        $total += $subtotal;
                    } else {
                        return redirect()->route('cart')->with('error', 'Error al procesar la transacción.');
                    }
                }
            }

            DB::commit();
            //envia el email 
            Mail::to($comprador->email)->send(new NotificacionPagoMail($productos));
            session()->forget('cart');

            return redirect()->route('comprador.home')->with('success', 'Transacción completada exitosamente.');
        } catch (\Exception $e) {
            /**
             * En caso de que de error revierte la transacción
             */
            DB::rollBack();
            return redirect()->route('cart')->with('error', 'Error al procesar la transacción.');
        }
    }
}
