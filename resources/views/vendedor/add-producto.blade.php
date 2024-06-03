@extends('layout.app-master')
@section('title', 'Agregar Producto')
@section('content')
<x-notification />
<x-product-form action-route="vendedor.producto.create-producto" :categorias="$categorias" button-text="Agregar Producto" />
@endsection