@extends('layout.app-master')
@section('title', 'Producto')
@section('content')
{{ Breadcrumbs::render('producto', $producto) }}

@if (isset($error))
    {{var_dump($error)}}
@endif

<section class="py-5">
    <div class="container container-comprador">
        <div class="row gx-5">
            <aside class="col-lg-6">
                <div id="carouselExample" class="carousel slide">
                    <div class="carousel-inner">
                        @if ($producto['imagenes'])
                        @foreach ( $producto['imagenes'] as $key => $imagen)
                        <div class="carousel-item @if ($key == 0) active @endif">
                            <img src="{{$imagen}}" class="d-block w-100" alt="{{$producto['nombre']}}">
                        </div>
                        @endforeach

                        @else
                        <div class="carousel-item active">
                            <img src="/img/productos/default-product.png" class="d-block w-100" alt="{{$producto['nombre']}}x">
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

                    <div class="d-flex flex-row my-3">
                        <span class="text-muted">Existencias : 
                            @if ($producto['existencias']>0)
                                <span class="text-success ms-2">{{$producto['existencias']}} Disponible</span>
                            @else
                                <span class="text-danger ms-2">No hay</span>
                        @endif
                        </span>
                    </div>
                    @php
                    $precio_final = $producto->precio_venta - ($producto->precio_venta * ($producto->descuento / 100));
                    @endphp
                    <div class="mb-3">
                        @if ($producto['descuento'] > 0)
                        <p class="h5 text-danger">Oferta {{$producto->descuento}}%</p>
                        <p class="text-danger"></p>
                        <p class="small">Precio original: <s class="text-danger">{{$producto->precio_venta}}€</s></p>
                        <p class="h5">Precio final: {{$precio_final}} €</p>
                        @else
                        <p class="h5">Precio final: {{$precio_final}} €</p>
                        @endif

                    </div>

                    <div>
                        {!! $producto['descripcion'] !!}
                    </div>

                    <div class="row">

                    </div>

                    <hr />

                    <div class="row mb-4">
                        <div class="col-md-4 col-6">
                            <h5>Categorías:</h5>
                            <ul>
                                @foreach($producto->categorias as $categoria)
                                <li>{{ $categoria->nombre }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-4 col-6 mb-3">
                            <label class="mb-2 d-block">Cantidad</label>
                            <div class="input-group mb-3" style="width: 170px;">
                                <button class="btn btn-white border border-secondary px-3" type="button" id="button-addon1" data-mdb-ripple-color="dark">
                                <i class="bi bi-dash"></i>
                                </button>
                                <input type="text" class="form-control text-center border border-secondary" min="1" max="{{$producto['existencias']}}" aria-label="Example text with button addon" aria-describedby="button-addon1" />
                                <button class="btn btn-white border border-secondary px-3" type="button" id="button-addon2" data-mdb-ripple-color="dark">
                                    <i class="bi bi-plus-lg"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @if ($producto->existencias > 0)
                    <a type="button" class="btn btn-comprador" href="{{route('cart-add', $producto->id)}}">Agregar al carrito</a>
                    @else
                        <span class="text-danger">No hay productos</span>
                    @endif
                    
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
                            @foreach ( $productosSimilares as $producto )
                            <div class="d-flex mb-3">
                                <a href="{{route('producto', $producto->id)}}" class="me-3">
                                    @if ($producto->imagen_portada)
                                    <img src="{{$producto->imagen_portada}}" style="min-width: 96px; height: 96px;" class="img-md img-thumbnail" />
                                    @else
                                    <img src="/img/productos/default-product.png" style="min-width: 96px; height: 96px;" class="img-md img-thumbnail" />
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
@endsection