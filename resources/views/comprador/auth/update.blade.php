@extends('layout.app-master')
@section('title', 'Actualización de datos')
@section('content')
<x-profile-update user-type="comprador" action-route="comprador.profile.update-handler"/>

@endsection