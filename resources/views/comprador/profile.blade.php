@extends('layout.app-master')
@section('title', 'Perfil')
@section('content')

<x-profile user-type="comprador" action-route="comprador.profile.update"/>

@endsection