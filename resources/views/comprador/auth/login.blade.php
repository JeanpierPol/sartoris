@extends('layout.app-master')
@section('title', 'Login Comprador')
@section('content')
<x-login-form user-type="comprador" action-route="comprador.login-handler" register-route="comprador.register" />
@endsection