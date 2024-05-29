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

    <p>APP_KEY: {{ env.template('APP_KEY') }}</p>
    <p>DB_HOST: {{ env.template('DB_HOST') }}</p>
    <p>MAIL_MAILER: {{ env.template('MAIL_MAILER') }}</p>
    <p>MAIL_HOST: {{ env.template('MAIL_HOST') }}</p>
    <p>MAIL_PORT: {{ env.template('MAIL_PORT') }}</p>
    <p>MAIL_USERNAME: {{ env.template('MAIL_USERNAME') }}</p>
    <p>MAIL_PASSWORD: {{ env.template('MAIL_PASSWORD') }}</p>
    <p>MAIL_ENCRYPTION: {{ env.template('MAIL_ENCRYPTION') }}</p>
    <p>MAIL_FROM_ADDRESS: {{ env.template('MAIL_FROM_ADDRESS') }}</p>
    <p>MAIL_FROM_NAME: {{ env.template('MAIL_FROM_NAME') }}</p>
@endsection