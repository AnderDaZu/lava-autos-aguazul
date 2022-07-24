@extends('adminlte::page')

@section('title', 'Servicios')

@section('content_header')
    <a class="btn btn-secondary btn-sm float-right" href="{{ route('admin.services.create') }}">Agregar Servicio</a>
    <h1>Lista de Servicios</h1>
@stop

@section('content')
    
    @include('sweetalert::alert')

    @livewire('admin.service-index') 
    
@stop