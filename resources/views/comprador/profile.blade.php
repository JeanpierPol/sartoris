@extends('layout.app-master')
@section('title', 'Perfil')
@section('content')
{{ Breadcrumbs::render('comprador_profile') }}
<x-notification />
<x-profile user-type="comprador" action-route="comprador.profile.update"/>

@endsection