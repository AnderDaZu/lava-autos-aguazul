@extends('adminlte::page')

@section('title', 'Empleados')

@section('content_header')
    <a class="btn btn-secondary btn-sm float-right" href="{{ route('admin.employees.create') }}">Crea Empleado</a>
    <h1>Lista de Empleados</h1>
@stop

@section('content')

    @include('sweetalert::alert')

    @livewire('admin.employee-index')

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
