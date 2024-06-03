@extends('layout.app-master')
@section('title', 'Sartoris')
@section('content')
{{ Breadcrumbs::render('productos') }}
<section class="productos">
    <div class="container py-5 container-comprador">
        <div class="row">
            @foreach ($productos as $producto)
            <div class="col-md-12 col-lg-4 mb-4">
                <a class="text-decoration-none text-reset" href="{{ route('producto', $producto->id) }}">
                    <div class="card h-100 d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex justify-content-between p-3">
                            </div>
                            @if ($producto->imagen_portada)
                            <img src="{{ $producto->imagen_portada }}" class="card-img-top w-100" alt="{{ $producto->nombre }}" />
                            @else
                            <img src="https://lh3.googleusercontent.com/drive-viewer/AKGpihZ0UBAp08RDRMzGL4UZHSpCTsycqFzQuKT5bFAOeAL8aK_dW3_XfG_qyCfmdeNOT6zebP3QKTqpgqEFCw2wL9SQeWJkyJFgTbY=w1920-h965" class="card-img-top w-100" alt="{{ $producto->nombre }}" />
                            @endif

                            <div class="card-body text-center">
                                <small class="fw-bold d-block">{{ $producto->nombre }} </small>
                                <small class="fw-bold"><span class="precio-final"></span></small>
                            </div>
    
                        </div>
                </a>
                <div class="card-footer mt-auto">
                    <div class="d-flex justify-content-between mb-2">
                    <form class="d-flex w-100" action="{{ route('cart-add', $producto->id) }}" method="POST">
                        @csrf
                        <select name="talla" class="btn w-50 me-2 talla-select" onchange="actualizarPrecio(this)">
                            <option value="" selected disabled>Seleccione una talla</option>
                            @foreach ($producto->variantes as $variante)
                                @if ($variante->existencias > 0)
                                    <option value="{{ $variante->id }}" data-precio="{{ $variante->precio_venta - ($variante->precio_venta * ($variante->descuento / 100)) }}">{{ $variante->talla }}</option>
                                @endif
                            @endforeach
                        </select>
                        <input type="submit" class="btn btn-comprador w-50 cartBtn" disabled value="Añadir">
                    </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    </div>
</section>

<script>
    function actualizarPrecio(selectElement) {
        let card = selectElement.closest('.card');
        let submitButton = card.querySelector('.cartBtn');
        let precioFinalSpan = card.querySelector('.precio-final');
        
        submitButton.disabled = false;
        let precioFinal = selectElement.options[selectElement.selectedIndex].getAttribute("data-precio");
        precioFinalSpan.innerText = precioFinal ? precioFinal + ' €' : 'Seleccione una talla';
    }
</script>
@endsection
