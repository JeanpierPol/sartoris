@extends('layout.app-master')
@section('title', 'Perfil')
@section('content')
{{ Breadcrumbs::render('vendedor_profile') }}
<x-notification />
<x-profile user-type="vendedor" action-route="vendedor.profile.update"/>
@endsection