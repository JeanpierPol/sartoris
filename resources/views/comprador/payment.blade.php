@extends('layout.app-master')
@section('title', 'Métodos de pago')
@section('content')
{{ Breadcrumbs::render('comprador_payment') }}
<div class="ms-4 mt-4">
    <div class="card border-0  p-4 text-white">
        <div class="top_div text-white d-flex justify-content-between align-items-center">
            <i class="bi bi-brightness-high fs-3"></i>
            <div class="symbols d-flex align-items-center">
                <i class="bi bi-wifi-2 fs-2 me-2 "></i>
                <img src="https://imgur.com/5mVCNBm.png" width=35>
            </div>

        </div>
        <div class="number mt-3 lh-1 ">

            <span>Número de tarjeta bancaria</span>

            <div class="d-flex gap-2 mt-2">
                <p>1234</p>
                <p>5678</p>
                <p>9101</p>
                <p>1121</p>
            </div>
        </div>
        <div class="name_exp d-flex justify-content-between mt-4">
            <div class="name">
                <span>Nombre</span>
                <p>{{Auth::guard('comprador')->user()->nombre}} {{Auth::guard('comprador')->user()->apellido}}</p>
            </div>
            
            <div class="expiry">
                <span>Fecha de vencimiento</span>
                <p>05/25</p>
            </div>
            <img src="https://imgur.com/uNN72Zm.png">
        </div>

    </div>


    <style>
        .card {
            height: 260px;
            width: 390px;
            border-radius: 10px;
            background-color: #3A3A3A;
        }

        .bi-wifi-2 {
            transform: rotate(90deg);
        }

        .number span:nth-child(1) {
            font-size: 10px;
        }

        .name_exp span {
            font-size: 10px;

        }

        .name_exp img {
            width: 40px;
            height: 40px;
        }
    </style>
</div>

@endsection