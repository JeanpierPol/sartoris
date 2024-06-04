@extends('layout.app-master')
@section('title', 'Productos vendidos')
@section('content')
<x-notification />
{{ Breadcrumbs::render('vendedor_sales') }}

<div class="content-wrapper mt-4">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Lista de transacciones </span>
        </h4>
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Filtro</h5>
                <div class="d-flex justify-content-between align-items-center row py-3 gap-3 gap-md-0">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-10 col-sm-9">Column</div>
                        </div>
                    </div>
                </div>
                <div class="card-datatable table-responsive">
                    <table class="datatables-products table">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($transacciones as $transaccion)
                            <tr>
                                <td>
                                    <div class="d-flex justify-content-start align-items-center product-name">
                                        <div class="avatar-wrapper">
                                            @if ($transaccion->producto->imagen_portada)
                                                <img src="{{ asset($transaccion->producto->imagen_portada) }}" alt="{{ $transaccion->producto->nombre }}" style="width: 100px; height: auto;">
                                            @else
                                                <img src="https://lh3.googleusercontent.com/drive-viewer/AKGpihZ0UBAp08RDRMzGL4UZHSpCTsycqFzQuKT5bFAOeAL8aK_dW3_XfG_qyCfmdeNOT6zebP3QKTqpgqEFCw2wL9SQeWJkyJFgTbY=w1920-h965" alt="{{ $transaccion->producto->nombre }}" style="width: 100px; height: auto;">
                                            @endif
                                        </div>
                                        <div class="d-flex flex-column">
                                            <h6 class="text-body text-nowrap mb-0">{{ $transaccion->producto->nombre }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {{$transaccion->cantidad}}
                                </td>
                                <td>
                                    {{$transaccion->subtotal}}
                                </td>
                                <td>{{$transaccion->fecha}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection