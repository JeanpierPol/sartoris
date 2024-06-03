@extends('layout.app-master')
@section('title', 'Registro vendedor')
@section('content')
<x-notification />
<x-register-form user-type="vendedor" action-route="vendedor.register-handler"/>
@endsection