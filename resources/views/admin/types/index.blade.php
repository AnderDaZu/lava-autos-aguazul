@extends('adminlte::page')

@section('title', 'Tipos de Vehículos')

@section('content_header')
    <a class="btn btn-secondary btn-sm float-right" href="{{ route('admin.types.create') }}">Crea Tipo de Vehículo</a>
    <h1>Lista de Tipos de Vehículos</h1>
@stop

@section('content')
    
    @include('sweetalert::alert')

    @livewire('admin.type-index') 
    
@stop 