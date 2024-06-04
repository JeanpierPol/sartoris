@extends('layout.app-master')
@section('title', 'Perfil')
@section('content')
<x-notification />
{{ Breadcrumbs::render('comprador_profile') }}
<x-profile user-type="comprador" action-route="comprador.profile.update"/>

@endsection