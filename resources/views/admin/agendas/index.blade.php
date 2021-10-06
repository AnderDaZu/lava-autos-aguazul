@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <a class="btn btn-secondary btn-sm float-right" href="{{ route('admin.agendas.create') }}">Crear Agenda</a>
    <h1>Lista de Agendas</h1>
@stop

@section('content')

    @include('sweetalert::alert')

    <div class="card row justify-content-md-center">

        @if ($agendas->count())
            <div class="card-body">
                <table class="table table-striped table-hover">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Fin</th>
                            <th colspan="2"></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($agendas as $agenda)
                            <tr>
                                <td>{{ $agenda->id }}</td>
                                <td>{{ $agenda->name }} {{ $agenda->last_name }}</td>
                                <td>
                                    Rol
                                </td>
                                <td>estado</td>
                                <td width="10px">
                                    @can('admin.agendas.edit')
                                        <a class="btn btn-primary btn-sm"
                                            href="{{ route('admin.agendas.edit', $agenda) }}">Editar</a>
                                    @endcan
                                </td>
                                <td width="10px">
                                    @can('admin.agendas.destroy')
                                        <form action="{{ route('admin.agendas.destroy', $agenda) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">Eleminar</button>
                                        </form>
                                    @endcan

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="card-body">
                No hay agendas registradas
            </div>
        @endif 

    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop