@extends('layout.app-master')
@section('title', 'Login vendedor')
@section('content')
<x-login-form user-type="vendedor" action-route="vendedor.login-handler" register-route="vendedor.register" />
@endsection