@extends('layout.app-master')
@section('title', 'Actualización de datos')
@section('content')
{{ Breadcrumbs::render('vendedor_update') }}
<x-notification />
<x-profile-update user-type="vendedor" action-route="vendedor.profile.update-handler"/>
@endsection