@extends('layout.app-master')
@section('title', 'Agregar Producto')
@section('content')
{{ Breadcrumbs::render('vendedor_add_producto') }}
<x-notification />
<x-product-form action-route="vendedor.producto.create-producto" :categorias="$categorias" button-text="Agregar Producto" />
@endsection