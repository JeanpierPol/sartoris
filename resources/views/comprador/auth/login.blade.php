@extends('layout.app-master')
@section('title', 'Login Comprador')
@section('content')
{{ Breadcrumbs::render('comprador_login') }}
<x-login-form user-type="comprador" action-route="comprador.login-handler" register-route="comprador.register" googleRoute="comprador.google-redirect" />
@endsection