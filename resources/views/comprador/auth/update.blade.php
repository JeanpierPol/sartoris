@extends('layout.app-master')
@section('title', 'Actualización de datos')
@section('content')
{{ Breadcrumbs::render('comprador_update') }}
<x-notification />
<x-profile-update user-type="comprador" action-route="comprador.profile.update-handler"/>

@endsection