@extends('layout.app-master')
@section('title', 'Login vendedor')
@section('content')
{{ Breadcrumbs::render('vendedor_login') }}
<x-notification />
<x-login-form user-type="vendedor" action-route="vendedor.login-handler" register-route="vendedor.register" googleRoute="vendedor.google-redirect"/>
@endsection