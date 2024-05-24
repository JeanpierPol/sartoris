@extends('layout.app-master')
@section('title', 'Sartoris')
@section('content')
<section class="h-100 h-custom cart">
{{ Breadcrumbs::render('cart') }}
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-lg-7">
                                <h5 class="mb-3"><a href="{{ URL::previous() }}" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>Continuar comprando</a></h5>
                                <hr>

                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div>
                                        <p class="mb-1">Carrito de compra</p>
                                    </div>
                                </div>

                                @if (session('cart') !== null)
                                @php
                                    $precio_final = 0;
                                    $totalProductos = 0;
                                @endphp
                                @foreach (session('cart') as $id => $producto)
                                    @php
                                        $precio_con_descuento = $producto['precio_venta'] - ($producto['precio_venta'] * ($producto['descuento'] / 100));
                                        $subtotal = $precio_con_descuento * $producto['cantidad'];
                                        $precio_final += $subtotal;
                                        $totalProductos += $producto['cantidad'];
                                    @endphp

                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">

                                            <div class="d-flex flex-row align-items-center">
                                                <div>
                                                    @if ($producto['imagen_portada'])
                                                       <a href="{{route('producto', $id)}}"><img src="/{{$producto['imagen_portada']}}" class="img-fluid rounded-3" alt="{{$producto['nombre']}}" style="width: 65px;"></a> 
                                                    @else
                                                        <a href="{{route('producto', $id)}}"><img src="/img/productos/default-product.png" class="img-fluid rounded-3" alt="{{$producto['nombre']}}" style="width: 65px;"></a>
                                                    @endif
                                                </div>

                                                <div class="ms-3">
                                                    <h5><a class="nav-link mb-1" href="{{route('producto', $id)}}">{{$producto['nombre']}}</a></h5>

                                                    @if ($producto['descuento'] > 0)
                                                    <p class="small mb-0 text-danger">{{$producto['descuento']}}% <span class="small text-danger"><s>{{$producto['precio_venta']}}</s>€</span> </p>
                                                    @endif
                                                    <p class="small mb-0"> Precio final: {{$precio_con_descuento}} €</p>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-row align-items-center">
                                                <p class="fw-normal mb-0 mr-1"> Cantidad: </p>
                                                <div style="width: 100px;">

                                                    <h5 class="fw-normal mb-0"> {{$producto['cantidad']}}</h5>
                                                </div>
                                                <div style="width: 80px;">
                                                    <h5 class="mb-0">{{ $subtotal}}€</h5>
                                                </div>
                                                <form action="{{ route('delete-cart', $id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="badge bg-danger p-2 m-0 border-0">
                                                        <i class="bi bi-x-lg"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @endforeach

                            </div>
                            <div class="col-lg-5">
                                <div class="mb-4">
                                    <h5>Total a pagar: {{ $precio_final }}€</h5>
                                </div>

                                <ul class="nav nav-pills nav-fill gap-2 p-1 small rounded-5 shadow-sm" id="pillNav2" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active rounded-5" id="home-tab2" data-bs-toggle="tab" data-bs-target="#tarjeta" type="button" role="tab" aria-controls="tarjeta" aria-selected="true">Tarjeta</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link rounded-5" id="profile-tab2" data-bs-toggle="tab" data-bs-target="#paypal" type="button" role="tab" aria-controls="paypal" aria-selected="false">Paypal</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link rounded-5" id="contact-tab2" data-bs-toggle="tab" data-bs-target="#transferencia" type="button" role="tab" aria-controls="transferencia" aria-selected="false">Transferencia bancaria</button>
                                    </li>
                                </ul>

                                <div class="tab-content mt-3">
                                    <div class="tab-pane fade show active" id="tarjeta" role="tabpanel" aria-labelledby="home-tab2">
                                        <form onsubmit="return confirm('metodo por ahora no implementado, le pedimos disculpas');">
                                            <div class="mb-3">
                                                <label for="cardNumber" class="form-label">Número de Tarjeta</label>
                                                <input type="text" class="form-control" id="cardNumber" placeholder="1234 5678 9012 3456">
                                            </div>
                                            <div class="mb-3">
                                                <label for="cardName" class="form-label">Nombre en la Tarjeta</label>
                                                <input type="text" class="form-control" id="cardName" placeholder="Nombre Completo">
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label for="expiryDate" class="form-label">Fecha de Expiración</label>
                                                        <input type="text" class="form-control" id="expiryDate" placeholder="MM/AA">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label for="cvv" class="form-label">CVV</label>
                                                        <input type="text" class="form-control" id="cvv" placeholder="123">
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn" >Pagar</button>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="paypal" role="tabpanel" aria-labelledby="profile-tab2">
                                        <form action="{{ route('paypal') }}" method="post">
                                            @csrf
                                            <div class="mb-3">
                                                <input type="hidden" name="price" value="{{$precio_final}}">
                                            </div>
                                            <button type="submit" class="btn"><i class="bi bi-paypal"> </i> Pagar con Paypal</button>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="transferencia" role="tabpanel" aria-labelledby="contact-tab2">
                                        <form onsubmit="return confirm('metodo por ahora no implementado, le pedimos disculpas');">
                                            <div class="mb-3">
                                                <label for="bankName" class="form-label">Nombre del Banco</label>
                                                <input type="text" class="form-control" id="bankName" placeholder="Nombre del Banco">
                                            </div>
                                            <div class="mb-3">
                                                <label for="accountNumber" class="form-label">Número de Cuenta</label>
                                                <input type="text" class="form-control" id="accountNumber" placeholder="1234567890">
                                            </div>
                                            <div class="mb-3">
                                                <label for="accountHolder" class="form-label">Nombre del Titular</label>
                                                <input type="text" class="form-control" id="accountHolder" placeholder="Nombre Completo">
                                            </div>
                                            <button type="submit" class="btn">Pagar por Transferencia</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection