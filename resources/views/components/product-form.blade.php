<section class="producto-vendedor container-vendedor">
    <div class="container py-5">
        <div class="row">
            <div class="col"></div>
        </div>
        <form id="product-form" action="{{ route($actionRoute, $producto ? ['id'=>$producto->id] : null) }}" method="post" enctype="multipart/form-data">
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
                    <div class="card mb-4 mb-lg-0 vendedor-scroll">
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
            <div class="card mt-4 mb-4">
                <div class="card-body table-responsive">
                    <p class="my-3">Variantes</p>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Talla</th>
                                <th scope="col">Precio de venta</th>
                                <th scope="col">Descuento</th>
                                <th scope="col">Existencias</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="variant-container">
                            @if(old('talla'))
                                @foreach(old('talla') as $index => $talla)
                                    <tr class="variant-row">
                                        <td>
                                            <div class="input-group mb-3">
                                                <select class="form-select" name="talla[]">
                                                    <option value="S" @if($talla == 'S') selected @endif>S</option>
                                                    <option value="M" @if($talla == 'M') selected @endif>M</option>
                                                    <option value="L" @if($talla == 'L') selected @endif>L</option>
                                                </select>
                                                @error('talla.' . $index)
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" step="0.01" name="precio_venta[]" value="{{ old('precio_venta.' . $index) }}" />
                                            @error('precio_venta.' . $index)
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" name="descuento[]" value="{{ old('descuento.' . $index) }}" />
                                            @error('descuento.' . $index)
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" name="existencias[]" value="{{ old('existencias.' . $index) }}" />
                                            @error('existencias.' . $index)
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-remove-variant">Eliminar</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @elseif(isset($producto))
                                @foreach($producto->variantes as $variante)
                                    <tr class="variant-row">
                                        <td>
                                            <div class="input-group mb-3">
                                                <select class="form-select" name="talla[]">
                                                    <option value="S" @if($variante->talla == 'S') selected @endif>S</option>
                                                    <option value="M" @if($variante->talla == 'M') selected @endif>M</option>
                                                    <option value="L" @if($variante->talla == 'L') selected @endif>L</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" step="0.01" name="precio_venta[]" value="{{ $variante->precio_venta }}" />
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" name="descuento[]" value="{{ $variante->descuento }}" />
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" name="existencias[]" value="{{ $variante->existencias }}" />
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-remove-variant" onclick="removeVariant({{ $variante->id }})">Eliminar</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="variant-row">
                                    <td>
                                        <div class="input-group mb-3">
                                            <select class="form-select" name="talla[]">
                                                <option value="S">S</option>
                                                <option value="M">M</option>
                                                <option value="L">L</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" step="0.01" name="precio_venta[]"/>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" name="descuento[]" />
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" name="existencias[]" />
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-remove-variant">Eliminar</button>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <button class="btn btn-login fw-bold" id="btn-add-variant">Agregar variante</button>
                </div>
            </div>
            <input type="submit" class="btn btn-login fw-bold" value="{{ $buttonText }}">
            <a href="javascript:history.back()" class="btn btn-login fw-bold">Cancelar</a>
        </form>
    </div>
</section>


<script>
    let editorcfg = {};
    editorcfg.toolbar = "mytoolbar";
    editorcfg.toolbar_mytoolbar = "{bold,italic}|{fontname,fontsize}|{forecolor,backcolor}|removeformat" + "#{undo,redo,fullscreenenter,fullscreenexit,}";

    let editor = new RichTextEditor("#descripcionPoducto", editorcfg);

    let btnAdd = document.querySelector('#btn-add-variant');
    let variantContainer = document.querySelector('#variant-container');

    function addRemoveVariantBtn() {
        let removeButtons = document.querySelectorAll('.btn-remove-variant');
        removeButtons.forEach(button => {
            button.addEventListener('click', function() {
                this.closest('tr').remove();
            });
        });
    }

    addRemoveVariantBtn();


    function removeVariant(id) {
        $.ajax({
            url: '/vendedor/producto/variante/delete/ ' + id,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                _method: 'DELETE'
            },
            dataType: 'json',
            success: function(response) {
                location.reload();
            },
            error: function(response) {
                alert('error');
            }
        });
    }

    btnAdd.addEventListener("click", function(event) {
        event.preventDefault();
        let selectedSizes = Array.from(document.querySelectorAll('select[name="talla[]"]')).map(select => select.value);
        let allSizes = ['S', 'M', 'L'];

        let unselectedSizes = allSizes.filter(size => !selectedSizes.includes(size));

        if (unselectedSizes.length > 0) {
            let newRow = document.createElement('tr');
            newRow.classList.add('variant-row');
            newRow.innerHTML = `
            <td>
                <div class="input-group mb-3">
                    <select class="form-select" name="talla[]">
                        ${unselectedSizes.map(size => `<option value="${size}">${size}</option>`).join('')}
                    </select>
                </div>
            </td>
            <td><input type="number" class="form-control" step="0.01" name="precio_venta[]"/></td>
            <td><input type="number" class="form-control" name="descuento[]"/></td>
            <td><input type="number" class="form-control" name="existencias[]"/></td>
            <td><button type="button" class="btn btn-danger btn-remove-variant">Eliminar</button></td>
        `;

            variantContainer.appendChild(newRow);

            addRemoveVariantBtn();
        } else {
            alert('No hay mas tallas');
        }
    });
    
</script>