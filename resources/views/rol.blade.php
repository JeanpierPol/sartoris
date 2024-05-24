@extends('layout.app-master')
@section('title', 'Asignar rol')
@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-6 justify-content-center align-items-center d-flex contenedor-rol">
        <div class="text-white">
          <a class="btn btn-lg btn-block btn-vendedor" href="{{route('comprador.login')}}">Iniciar sesión como comprador</a>
          <p>O</p>
          <a class="btn btn-lg btn-block btn-vendedor" href="{{route('vendedor.login')}}">Iniciar sesión como vendedor</a>
        </div>
      </div>
      <div class="col-6 imagen_asignar_rol" style="background-image: url('/img/rol.png');">
      </div>
    </div>
@endsection