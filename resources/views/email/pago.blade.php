<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>

<body>
    <h1>Detalles de la Compra</h1>
    <ul>
        @php
            $precio_final = 0;
            $totalProductos = 0;
        @endphp
        @foreach ($mailData as $id => $producto)
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
                            <a href="{{route('producto', $id)}}"><img src="{{$producto['imagen_portada']}}" class="img-fluid rounded-3" alt="{{$producto['nombre']}}" style="width: 65px;"></a>
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
                    </div>
                </div>
            </div>
        </div>

        @endforeach
    </ul>
</body>

</html>