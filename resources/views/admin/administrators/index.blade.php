@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <a  href="{{ route('admin.administrators.create') }}" class="btn btn-secondary btn-sm float-right">Crear Administrador</a>
    <h1>Lista de Administradores</h1>
@stop

@section('content')

    @include('sweetalert::alert')

    @livewire('admin.administrator-index')

    {{-- <div class="card row justify-content-md-center">

        @if ($users->count())
            <div class="card-body">
                <table class="table table-striped table-hover">

                    @include('admin.partials.thead')

                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }} {{ $user->last_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
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
                                            <button type="submit" class="btn btn-danger btn-sm">Eleminar</button>
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
                No hay Administradores registrados
            </div>
        @endif
    </div> --}}
@stop
