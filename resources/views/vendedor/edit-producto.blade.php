@extends('layout.app-master')
@section('title', 'Editar Producto')
@section('content')
{{ Breadcrumbs::render('vendedor_edit_producto', $producto->id) }}
<x-notification />
<x-product-form action-route="vendedor.producto.update-producto" :categorias="$categorias" :producto="$producto" button-text="Guardar cambios" />

@endsection
