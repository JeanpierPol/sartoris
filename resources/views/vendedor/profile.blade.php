@extends('layout.app-master')
@section('title', 'Perfil')
@section('content')
<x-notification />
{{ Breadcrumbs::render('vendedor_profile') }}
<x-profile user-type="vendedor" action-route="vendedor.profile.update"/>
@endsection