@extends('layout.app-master')
@section('title', 'Actualización de datos')
@section('content')
<x-notification />
<x-profile-update user-type="vendedor" action-route="vendedor.profile.update-handler"/>
@endsection