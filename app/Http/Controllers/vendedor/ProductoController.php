<?php

namespace App\Http\Controllers\vendedor;

use App\Http\Controllers\Controller;
use App\Http\Requests\vendedor\VendedorProductoCreateRequest;
use App\Http\Requests\vendedor\VendedorProductoUpdateRequest;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Variante;
use App\Models\Vendedor;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Vista para agregar producto
     */
    public function addProducto(Request $request)
    {
        $categorias = Categoria::orderBy('nombre', 'asc')->get();
        return view('vendedor.add-producto', compact('categorias'));
    }

    /**
     * Metodo para guardar producto
     */

    public function createProducto(VendedorProductoCreateRequest $request)
    {
        $id_vendedor = auth()->id();

        $producto_imagen_portada = null;
        $producto_imagenes = [];


        /*
            Guarda las imágenes en un array
        */
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
        $producto->vendedor_id = $id_vendedor;
        $producto->save();

        if ($request->has('categorias')) {
            $categorias = $request->input('categorias');
            $producto->categorias()->sync($categorias);
        }

        /*
        Asigna la talla recorriendo el input de las tallas
        */

        if ($request->has('talla')) {
            foreach ($request->input('talla') as $index => $talla) {
                $variante = new Variante();
                $variante->producto_id = $producto->id;
                $variante->talla = $talla;
                $variante->precio_venta = $request->input('precio_venta')[$index];
                $variante->descuento = $request->input('descuento')[$index];
                $variante->existencias = $request->input('existencias')[$index];
                $variante->save();
            }
        }

        return redirect()->route('vendedor.producto.all-productos')->with('success', 'Producto creado exitosamente.');
    }
    /**
     * Vista para todos los productos asociados al comprador
     */
    public function allProductos()
    {
        $vendedor_id = auth()->id();
        $vendedor = Vendedor::findOrFail($vendedor_id);
        $productos = $vendedor->productos()->with('variantes')->get();
        return view('vendedor.productos', compact('productos'));
    }
    /**
     * Vista para editar producto
     */

    public function editProducto(Request $request)
    {
        $producto = Producto::findOrFail($request->id);
        $categorias = Categoria::all();
        return view('vendedor.edit-producto', compact('producto', 'categorias'));
    }
    /**
     * Función para actualizar producto
     */

    public function updateProducto(VendedorProductoUpdateRequest $request)
    {
        $producto = Producto::findOrFail($request->id);

        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;

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
    
        // Verifica si la solicitud contiene categorias
        if ($request->has('categorias')) {
            $categorias = $request->input('categorias');
            /*
            Sincroniza las categorías del producto con las categorías proporcionadas en la solicitud.
            El método sync actualiza la tabla intermedia, añadiendo nuevas relaciones y eliminando las que no están en el array.
            */
            $producto->categorias()->sync($categorias);
        } else {
            // Si no se proporcionan categorías, el método detach elimina todas las relaciones de categorías del producto.
            $producto->categorias()->detach();
        }


        $variantesActuales = $producto->variantes()->pluck('id')->toArray();
        $variantesSolicitadas = collect($request->input('talla'))->map(function ($talla, $index) use ($request) {
            return [
                'talla' => $talla,
                'precio_venta' => $request->input('precio_venta')[$index],
                'descuento' => $request->input('descuento')[$index],
                'existencias' => $request->input('existencias')[$index]
            ];
        });

        foreach ($variantesSolicitadas as $variante) {
            if (isset($variante['id'])) {
                $producto->variantes()->where('id', $variante['id'])->update($variante);
                unset($variantesActuales[array_search($variante['id'], $variantesActuales)]);
            } else {
                $producto->variantes()->create($variante);
            }
        }

        if (!empty($variantesActuales)) {
            Variante::destroy($variantesActuales);
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

    public function deleteVariant($id)
    {
        try {
            $variante = Variante::findOrFail($id);
            $variante->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error eliminando la variante'], 500);
        }
    }
}
