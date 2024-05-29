@extends('layout.app-master')
@section('title', 'Editar Producto')
@section('content')

<x-product-form action-route="vendedor.producto.update-producto" :categorias="$categorias" :producto="$producto" button-text="Guardar cambios" />

@endsection
