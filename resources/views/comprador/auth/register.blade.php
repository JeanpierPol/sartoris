@extends('layout.app-master')
@section('title', 'Registro Comprador')
@section('content')
<x-notification />
{{ Breadcrumbs::render('comprador_register') }}
<x-register-form user-type="comprador" action-route="comprador.register-handler" />
@endsection