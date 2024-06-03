@extends('layout.app-master')
@section('title', 'Producto')
@section('content')
<x-notification />
{{ Breadcrumbs::render('producto', $producto->id) }}
<section class="py-5">
    <div class="container container-comprador">
        <div class="row gx-5">
            <aside class="col-lg-6">
                <div id="carouselExample" class="carousel slide">
                    <div class="carousel-inner">
                        @if ($producto['imagenes'])
                        @foreach ($producto['imagenes'] as $key => $imagen)
                        <div class="carousel-item @if ($key == 0) active @endif">
                            <img src="{{$imagen}}" class="d-block w-100" alt="{{$producto['nombre']}}">
                        </div>
                        @endforeach
                        @else
                        <div class="carousel-item active">
                            <img src="https://lh3.googleusercontent.com/drive-viewer/AKGpihZ0UBAp08RDRMzGL4UZHSpCTsycqFzQuKT5bFAOeAL8aK_dW3_XfG_qyCfmdeNOT6zebP3QKTqpgqEFCw2wL9SQeWJkyJFgTbY=w1920-h965" class="d-block w-100" alt="{{$producto['nombre']}}x">
                        </div>
                        @endif
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </aside>
            <main class="col-lg-6">
                <div class="ps-lg-3">
                    <h4 class="title text-dark">
                        {{$producto['nombre']}}
                    </h4>
                    <hr>
                    <span>Vendedor: <a href="{{route('vendedor-productos', $producto->vendedor->id)}}">{{$producto->vendedor->nickname}}</a></span>

                    <div class="mt-4">
                        {!! $producto['descripcion'] !!}
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-4 col-6">
                            <h5>Categorías:</h5>
                            <ul>
                                @foreach($producto->categorias as $categoria)
                                <li>{{ $categoria->nombre }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <hr />

                    <div class="mb-3">
                        <p class="h5">Precio final: <span id="precio-final">Seleccione una talla</span></p>
                    </div>

                    <form class="d-flex w-100" action="{{ route('cart-add', $producto->id) }}" method="POST">
                        @csrf
                        <select name="talla" id="talla" class="btn w-50 me-2" onchange="actualizarPrecio()">
                            <option value="" selected disabled>Seleccione una talla</option>
                            @foreach ($producto->variantes as $variante)
                                @if ($variante->existencias > 0)
                                    <option value="{{ $variante->id }}" data-precio="{{ $variante->precio_venta - ($variante->precio_venta * ($variante->descuento / 100)) }}">{{ $variante->talla }}</option>
                                @endif
                            @endforeach
                        </select>
                        <input type="submit" class="btn btn-comprador w-50" id="cartBtn" disabled    value="Añadir">
                    </form>
                </div>
            </main>
        </div>
    </div>
</section>

<section class="bg-light border-top py-4">
    <div class="container">
        <div class="row gx-4">
            <div class="col-lg-8 mb-4">
            </div>
            <div class="col-lg-4">
                <div class="px-0 border rounded-2 shadow-0">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Productos similares</h5>
                            @foreach ($productosSimilares as $producto)
                            <div class="d-flex mb-3">
                                <a href="{{route('producto', $producto->id)}}" class="me-3">
                                    @if ($producto->imagen_portada)
                                    <img src="{{$producto->imagen_portada}}" style="min-width: 96px; height: 96px;" class="img-md img-thumbnail" />
                                    @else
                                    <img src="https://lh3.googleusercontent.com/drive-viewer/AKGpihZ0UBAp08RDRMzGL4UZHSpCTsycqFzQuKT5bFAOeAL8aK_dW3_XfG_qyCfmdeNOT6zebP3QKTqpgqEFCw2wL9SQeWJkyJFgTbY=w1920-h965" style="min-width: 96px; height: 96px;" class="img-md img-thumbnail" />
                                    @endif
                                </a>
                                <div class="info">
                                    <a href="{{route('producto', $producto->id)}}" class="nav-link mb-1">
                                        {{$producto->nombre}}
                                    </a>
                                    <strong class="text-dark">{{ $producto->precio_venta - ($producto->precio_venta * ($producto->descuento / 100))}}€</strong>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function actualizarPrecio() {
        document.querySelector('#cartBtn').disabled = false;
        var select = document.getElementById("talla");
        var precioFinal = select.options[select.selectedIndex].getAttribute("data-precio");
        document.getElementById("precio-final").innerText = precioFinal ? precioFinal + ' €' : 'Seleccione una talla';
    }
</script>

@endsection
