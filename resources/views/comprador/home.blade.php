@extends('layout.app-master')
@section('title', 'Inicio Comprador ')
@section('content')
<x-notification />
{{ Breadcrumbs::render('comprador_home') }}
<div class="container mt-4 home-comprador">
    <div class="row">
        <div class="col-md-4 col-xl-4">
            <a class="text-decoration-none" href="{{route('comprador.profile')}}">
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
            <a class="text-decoration-none" href="{{route('comprador.orders')}}">
                <div class="card bg-c-green order-card">
                    <div class="card-block">
                        <h6 class="m-b-20">Mis pedidos</h6>
                        <h2 class="text-right"><i class="bi bi-cart-check-fill"></i></i></h2>
                        <p class="m-b-0">Ver mis pedidos</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 col-xl-4">
            <a class="text-decoration-none" href="{{route('comprador.payment')}}">
                <div class="card bg-c-yellow order-card">
                    <div class="card-block">
                        <h6 class="m-b-20">Métodos de pago</h6>
                        <h2 class="text-right"><i class="bi bi-credit-card-fill"></i></i></h2>
                        <p class="m-b-0">Ver métodos de pago guardados</p>
                    </div>
                </div>
            </a>
        </div>

    </div>
</div>
@endsection