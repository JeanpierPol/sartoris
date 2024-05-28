@extends('layout.app-master')
@section('title', 'Inicio vendedor')
@section('content')
<div class="container mt-4 home-vendedor">
    <div class="row">
        <div class="col-md-4 col-xl-4">
            <a class="text-decoration-none" href="{{route('vendedor.profile')}}">
                <div class="card bg-c-blue order-card">
                    <div class="card-block">
                        <h6 class="m-b-20">Mi perfil</h6>
                        <h2 class="text-right"><i class="bi bi-person-fill"></i><span></span></h2>
                        <p class="m-b-0">Ver perfil, editar perfil</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 col-xl-4">
            <a class="text-decoration-none" href="{{route('vendedor.sales')}}">
                <div class="card bg-c-green order-card">
                    <div class="card-block">
                        <h6 class="m-b-20">Ventas</h6>
                        <h2 class="text-right"><i class="bi bi-shop"></i></h2>
                        <p class="m-b-0">Ver mis ventas</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 col-xl-4">
            <a class="text-decoration-none" href="{{route('vendedor.producto.all-productos')}}">
                <div class="card bg-c-yellow order-card">
                    <div class="card-block">
                        <h6 class="m-b-20">Mis productos</h6>
                        <h2 class="text-right"><i class="bi bi-sunglasses"></i></i></h2>
                        <p class="m-b-0">Ver métodos de pago guardados</p>
                    </div>
                </div>
            </a>
        </div>

    </div>
</div>


@endsection