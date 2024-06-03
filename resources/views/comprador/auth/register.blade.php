@extends('layout.app-master')
@section('title', 'Registro Comprador')
@section('content')
<x-notification />
<x-register-form user-type="comprador" action-route="comprador.register-handler" />
@endsection