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
        <table>
            <tr>
                <th>Nombre</th>
                <th>Descuento</th>
                <th>Precio Venta</th>
                <th>Precio con Descuento</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
            </tr>
            @foreach ($mailData as $id => $producto)
                @php
                    $precio_con_descuento = $producto['precio_venta'] - ($producto['precio_venta'] * ($producto['descuento'] / 100));
                    $subtotal = $precio_con_descuento * $producto['cantidad'];
                    $precio_final += $subtotal;
                    $totalProductos += $producto['cantidad'];
                @endphp

                <tr>
                    <td><a href="{{route('producto', $id)}}">{{$producto['nombre']}}</a></td>
                    <td>
                        @if ($producto['descuento'] > 0)
                            <span class="text-danger">{{$producto['descuento']}}% <s>{{$producto['precio_venta']}}€</s></span>
                        @else
                            Sin descuento
                        @endif
                    </td>
                    <td>{{$producto['precio_venta']}}€</td>
                    <td>{{$precio_con_descuento}}€</td>
                    <td>{{$producto['cantidad']}}</td>
                    <td>{{$subtotal}}€</td>
                </tr>
            @endforeach
        </table>
    </ul>

    <h2>Resumen</h2>
    <table>
        <tr>
            <th>Total de Productos</th>
            <th>Precio Final</th>
        </tr>
        <tr>
            <td>{{$totalProductos}}</td>
            <td>{{$precio_final}}€</td>
        </tr>
    </table>
</body>



</html>