<?php

namespace App\Http\Controllers;

use App\Mail\NotificacionPagoMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\DetalleTransaccion;
use App\Models\Producto;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class TransaccionController extends Controller
{
    public function success()
    {
        $productos = session('cart');
        $comprador = null;

        if (Auth::guard('comprador')->check()) {
            $comprador = Auth::guard('comprador')->user();
        }

        Log::info('Iniciando transacción para comprador: ' . $comprador->email);

        DB::beginTransaction();

        try {
            $total = 0;

            foreach ($productos as $id => $productoData) {
                Log::info('Procesando producto ID: ' . $id);

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
                } else {
                    Log::warning('Producto no encontrado: ' . $id);
                }
            }

            DB::commit();
            Log::info('Transacción completada, enviando correo a: ' . $comprador->email);

            Mail::to($comprador->email)->send(new NotificacionPagoMail($productos));

            session()->forget('cart');

            return redirect()->route('comprador.home')->with('success', 'Transacción completada exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error en la transacción: ' . $e->getMessage());
            return redirect()->route('cart')->with('error', 'Error al procesar la transacción.');
        }
    }
}

