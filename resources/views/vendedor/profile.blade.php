@extends('layout.app-master')
@section('title', 'Perfil')
@section('content')
<x-notification />
<x-profile user-type="vendedor" action-route="vendedor.profile.update"/>
@endsection