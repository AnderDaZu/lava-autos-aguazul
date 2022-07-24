@extends('adminlte::page')

@section('title', 'Líneas Vehículos')

@section('content_header')
    <a class="btn btn-secondary btn-sm float-right" href="{{ route('admin.modelcars.create') }}">Crea Línena de Vehículo</a>
    <h1>Lista de Líneas de Vehículos</h1>
@stop

@section('content')
    
    @include('sweetalert::alert')

    @livewire('admin.modelcar-index') 
    
@stop 