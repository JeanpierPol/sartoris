@extends('layout.app-master')
@section('title', 'Sartoris')
@section('content')
{{ Breadcrumbs::render('buscar-productos') }}
<section class="productos ">
    <div class="container py-5 container-comprador">
        <div class="row">
            @foreach ($productos as $producto)
            
            @php
                $precio_final = $producto->precio_venta - ($producto->precio_venta * ($producto->descuento / 100));
            @endphp
            <div class="col-md-12 col-lg-4 mb-4">
                <div class="card h-100 d-flex flex-column justify-content-between">

                    <div>
                        <div class="d-flex justify-content-between p-3">
                        </div>
                        @if ($producto->imagen_portada)
                            <img src="{{$producto->imagen_portada}}" class="card-img-top w-100" alt="{{$producto->nombre}}" />
                        @else
                            <img src="/img/productos/default-product.png" class="card-img-top w-100" alt="{{$producto->nombre}}" />
                        @endif
                        
                        <div class="card-body">
                            @if ($producto->descuento>0)
                                <div class="d-flex justify-content-between">
                                    <p class="small">Oferta</p>
                                    <p class="text-danger">{{$producto->descuento}}%</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p class="small">Precio original</p>
                                    <p class="small text-danger"><s>{{$producto->precio_venta}}€</s></p>
                                </div>
                            @endif
                            <div class="d-flex justify-content-between mb-3">
                                <h5 class="mb-0">{{$producto->nombre}}</h5>
                                <h5 class="text-dark mb-0">${{$precio_final}} €</h5>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer mt-auto">
                        <div class="d-flex justify-content-between mb-2">
                            <p class="text-muted mb-0">Existencias: <span class="fw-bold">{{$producto->existencias}}</span></p>
                            <div>
                                <a type="button" class="btn btn-comprador" href="{{route('cart-add', $producto->id)}}">Agregar al carrito</a>
                                <a type="button" class="btn btn-success" href="{{route('producto', $producto->id)}}">Ver mas</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
