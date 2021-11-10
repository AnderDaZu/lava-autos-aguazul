@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    {{-- <a class="btn btn-secondary btn-sm float-right" href="{{ route('admin.agendas.create') }}">Crear Agenda</a> --}}
    <h1>Lista de citas agendadas</h1>
@stop

@section('content')

    @include('sweetalert::alert')

    {{-- @livewire('admin.agenda-index') --}}
    @livewire('admin.appointment-index')

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop