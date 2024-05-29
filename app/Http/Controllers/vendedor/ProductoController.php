<?php

namespace App\Http\Controllers\vendedor;

use App\Http\Controllers\Controller;
use App\Http\Requests\vendedor\VendedorProductoCreateRequest;
use App\Http\Requests\vendedor\VendedorProductoUpdateRequest;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Vendedor;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function addProducto(Request $request)
    {
        $categorias = Categoria::orderBy('nombre', 'asc')->get();
        return view('vendedor.add-producto', compact('categorias'));
    }

    public function createProducto(VendedorProductoCreateRequest $request)
    {
        $id_vendedor = auth()->id();

        $producto_imagen_portada = null;
        $producto_imagenes = [];

        if ($request->hasFile('imagen')) {
            $path = "/img/productos/$id_vendedor/" . date("YmdHis");
            foreach ($request->file('imagen') as $image) {
                $imageName = time() . uniqid() . $image->getClientOriginalName();
                $image->move(public_path($path), $imageName);
                $producto_imagen_portada = "$path/$imageName";
                $producto_imagenes[] = $producto_imagen_portada;
            }
        }

        $producto = new Producto();
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->imagen_portada = $producto_imagen_portada;
        $producto->imagenes = json_encode($producto_imagenes);
        $producto->precio_venta = $request->precio_venta;
        $producto->descuento = $request->descuento;
        $producto->existencias = $request->existencias;
        $producto->vendedor_id = $id_vendedor;
        $producto->save();

        if ($request->has('categorias')) {
            $categorias = $request->input('categorias');
            $producto->categorias()->sync($categorias);
        }

        return redirect()->route('vendedor.producto.all-productos')->with('success', 'Producto creado exitosamente.');
    }

    public function allProductos()
    {
        $vendedor_id = auth()->id();
        $vendedor = Vendedor::findOrFail($vendedor_id);
        $productos = $vendedor->productos;
        return view('vendedor.productos', compact('productos'));
    }

    public function editProducto(Request $request)
    {
        $producto = Producto::findOrFail($request->id);
        $categorias = Categoria::all();
        return view('vendedor.edit-producto', compact('producto', 'categorias'));
    }

    public function updateProducto(VendedorProductoUpdateRequest $request)
    {
        $producto = Producto::findOrFail($request->id);

        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio_venta = $request->precio_venta;
        $producto->descuento = $request->descuento;
        $producto->existencias = $request->existencias;

        if ($request->hasFile('imagen')) {
            $oldImages = $producto->oldImages();

            foreach ($oldImages as $oldImage) {
                if (is_string($oldImage) && file_exists(public_path($oldImage))) {
                    unlink(public_path($oldImage));
                }
            }
            $path = "/img/productos/{$producto->vendedor_id}/" . date("YmdHis");
            $producto_imagenes = [];
            foreach ($request->file('imagen') as $image) {
                $imageName = time() . uniqid() . $image->getClientOriginalName();
                $image->move(public_path($path), $imageName);
                $producto_imagenes[] = "$path/$imageName";
            }

            $producto->imagen_portada = $producto_imagenes[0];
            $producto->imagenes = json_encode($producto_imagenes);
        }

        $producto->save();

        if ($request->has('categorias')) {
            $categorias = $request->input('categorias');
            $producto->categorias()->sync($categorias);
        } else {
            $producto->categorias()->detach();
        }

        return redirect()->route('vendedor.producto.all-productos')->with('success', 'Producto actualizado exitosamente.');
    }

    public function deleteProducto(Request $request)
    {
        $producto = Producto::findOrFail($request->id);
        $oldImages = $producto->oldImages();
        foreach ($oldImages as $oldImage) {
            if (is_string($oldImage) && file_exists(public_path($oldImage))) {
                unlink(public_path($oldImage));
            }
        }
        $producto->categorias()->detach();
        $producto->delete();
        
        return redirect()->route('vendedor.producto.all-productos')->with('success', 'Producto eliminado exitosamente.');
    }
    
    
}
