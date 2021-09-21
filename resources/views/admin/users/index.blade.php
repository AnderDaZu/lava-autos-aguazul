@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <a  href="{{ route('admin.administrators.create') }}" class="btn btn-secondary btn-sm float-right">Crear Administrador</a>
    <h1>Lista de Usuarios</h1>
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif

    <div class="card row justify-content-md-center">

        <div class="card-body">
            <table class="table table-striped table-hover">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Rol</th>
                        <th>Estado</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }} {{ $user->last_name }}</td>
                            <td>
                                Rol
                            </td>
                            <td>estado</td>
                            <td width="10px">
                                @can('admin.administrators.edit')
                                    <a class="btn btn-primary btn-sm"
                                        href="{{ route('admin.administrators.edit', $user) }}">Editar</a>
                                @endcan
                            </td>
                            <td width="10px">
                                @can('admin.administrators.destroy')
                                    <form action="{{ route('admin.administrators.destroy', $user) }}" method="POST">
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
