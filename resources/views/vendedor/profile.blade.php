@extends('layout.app-master')
@section('title', 'Perfil')
@section('content')
<x-profile user-type="vendedor" action-route="vendedor.profile.update"/>
@endsection