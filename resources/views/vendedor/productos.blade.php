@extends('layout.app-master')
@section('title', 'Productos')
@section('content')
{{ Breadcrumbs::render('vendedor_productos') }}

<x-notification />
<div class="content-wrapper mt-4">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Lista de productos </span>
        </h4>
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Filtro</h5>
                <div class="d-flex justify-content-between align-items-center row py-3 gap-3 gap-md-0">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-10 col-sm-9">Column</div>
                            <div class="col-lg-2 col-sm-3"><a type="button" class="btn btn-vendedor fw-bold" href="{{route('vendedor.producto.add-producto')}}">Agregar producto</a></div>
                        </div>
                    </div>
                </div>
                <div class="card-datatable table-responsive">
                    <table class="datatables-products table">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Categoría</th>
                                <th>Talla</th>
                                <th>Existencias</th>
                                <th>Descuento</th>
                                <th>Precio</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($productos as $producto)
                                <tr>
                                    <td>
                                        <div class="d-flex justify-content-start align-items-center product-name">
                                            <div class="avatar-wrapper">
                                                @if ($producto->imagen_portada)
                                                    <img src="{{ asset($producto->imagen_portada) }}" alt="{{ $producto->nombre }}" style="width: 100px; height: auto;">
                                                @else
                                                    <img src="https://lh3.googleusercontent.com/drive-viewer/AKGpihZ0UBAp08RDRMzGL4UZHSpCTsycqFzQuKT5bFAOeAL8aK_dW3_XfG_qyCfmdeNOT6zebP3QKTqpgqEFCw2wL9SQeWJkyJFgTbY=w1920-h965" alt="{{ $producto->nombre }}" style="width: 100px; height: auto;">
                                                @endif
                                            </div>
                                            <div class="d-flex flex-column">
                                                <h6 class="text-body text-nowrap mb-0">{{ $producto->nombre }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @foreach($producto->categorias as $categoria)
                                            <small class="text-muted text-truncate d-none d-sm-block">{{ $categoria->nombre }}@if(!$loop->last),</small>@endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($producto->variantes as $variante)
                                            <p> {{$variante->talla}}</p>
                                        @endforeach
                                    </td>

                                    <td>
                                        @foreach ($producto->variantes as $variante)
                                            <p> {{$variante->existencias}}</p>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($producto->variantes as $variante)
                                            <p> {{$variante->descuento}}</p>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($producto->variantes as $variante)
                                                <p> {{$variante->precio_venta}}</p>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a type="button" class="btn btn-warning d-inline" href="{{ route('vendedor.producto.edit-producto', ['id' => $producto->id]) }}">Editar</a>
                                        <form action="{{ route('vendedor.producto.delete-producto', ['id' => $producto->id]) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este producto?');" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-danger ">Eliminar</button>
                                        </form>
                                    </td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endsection