@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <a class="btn btn-secondary btn-sm float-right" href="{{ route('admin.employees.create') }}">Crea Empleado</a>
    <h1>Lista de Empleados</h1>
@stop

@section('content')

    @include('sweetalert::alert')

    @livewire('admin.employee-index')

    {{-- <div class="card row justify-content-md-center">

        @if ($employees->count())
            <div class="card-body">
                <table class="table table-striped table-hover">

                    @include('admin.partials.thead')

                    <tbody>
                        @foreach ($employees as $employee)
                            <tr>
                                <td>{{ $employee->id }}</td>
                                <td>{{ $employee->name }} {{ $employee->last_name }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->phone }}</td>
                                <td>estado</td>
                                <td width="10px">
                                    @can('admin.employees.edit')
                                        <a class="btn btn-primary btn-sm"
                                            href="{{ route('admin.employees.edit', $employee) }}">Editar</a>
                                    @endcan
                                </td>
                                <td width="10px">
                                    @can('admin.employees.destroy')
                                        <form action="{{ route('admin.employees.destroy', $employee) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">
                                                Eleminar
                                            </button>
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
                No hay Empleados registrados
            </div>
        @endif
    </div> --}}
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
