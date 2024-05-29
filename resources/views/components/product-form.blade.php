<section class="producto-vendedor container-vendedor">
    <div class="container py-5">
        <div class="row">
            <div class="col">

            </div>
        </div>
        <form action="{{ route($actionRoute, $producto ? ['id'=>$producto->id]: null) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col">
                                    <label for="nombreProducto">Nombre del producto</label>
                                    <input type="text" class="form-control" id="nombreProducto" name="nombre" value="{{ old('nombre', $producto->nombre ?? '') }}">
                                    <x-error-message field="nombre" />
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label for="descripcionPoducto">Descripción del producto</label>
                                    <textarea id="descripcionPoducto" name="descripcion">{{ old('descripcion', $producto->descripcion ?? '') }}</textarea>
                                    <x-error-message field="descripcion" />
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col mt-4 mb-4">
                                    <label for="formFile" class="form-label">Imágenes del producto</label>
                                    <input class="form-control profile-vendedor" type="file" id="formFile" name="imagen[]" multiple accept="image/png, image/jpeg">
                                    @if (isset($producto->imagen_portada))
                                    <img src="/{{$producto->imagen_portada}}" alt="">
                                    @endif

                                    <x-error-message field="imagen" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="col">
                                <p class="my-3">Precio</p>
                                <input type="number" class="form-control" id="precioProducto" name="precio_venta" value="{{ old('precio_venta', $producto->precio_venta ?? '') }}">
                                <x-error-message field="precio_venta" />
                            </div>
                            <div class="col">
                                <p class="my-3">Existencias</p>
                                <input type="number" class="form-control" id="existenciasProducto" name="existencias" value="{{ old('existencias', $producto->existencias ?? '') }}">
                                <x-error-message field="existencias" />
                            </div>
                            <div class="col">
                                <p class="my-3">Descuento</p>
                                <input type="number" class="form-control" id="descuentoProducto" name="descuento" value="{{ old('descuento', $producto->descuento ?? '') }}">
                                <x-error-message field="descuento" />
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4 mb-lg-0">
                        <div class="card-body p-0">
                            <p class="my-3">Categorías</p>
                            <ul class="list-group list-group-flush rounded-3">

                                @foreach ($categorias as $categoria)
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    {{ $categoria->nombre }}
                                    <input type="checkbox" name="categorias[]" value="{{ $categoria->id }}" @if (isset($producto) && $producto->categorias->contains($categoria)) checked @endif>
                                </li>
                                @endforeach

                            </ul>
                            <x-error-message field="categorias" />
                        </div>
                    </div>
                </div>
            </div>
            <input type="submit" class="btn btn-login fw-bold" value="{{ $buttonText }}">
            <a href="{{url()->previous()}}" class="btn btn-login fw-bold">Cancelar</a>
        </form>
        
    </div>
</section>

<script>
    let editorcfg = {}
    editorcfg.toolbar = "mytoolbar";
    editorcfg.toolbar_mytoolbar = "{bold,italic}|{fontname,fontsize}|{forecolor,backcolor}|removeformat" + "#{undo,redo,fullscreenenter,fullscreenexit,}";

    let editor = new RichTextEditor("#descripcionPoducto", editorcfg);
</script>