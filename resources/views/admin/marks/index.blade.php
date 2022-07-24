@extends('adminlte::page')

@section('title', 'Marcas')

@section('content_header')
    <a class="btn btn-secondary btn-sm float-right" href="{{ route('admin.marks.create') }}">Agregar Marca de Vehículo</a>
    <h1>Marcas de Vehículos</h1>
@stop

@section('content')
    
    @include('sweetalert::alert')

    @livewire('admin.mark-index')

    {{-- @include('sweetalert::alert')

    <div class="card row justify-content-md-center">

        @if ($marks->count()) 
            <div class="card-body">
                <table class="table table-striped table-hover">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th colspan="2"></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($marks as $mark)
                            <tr>
                                <td>{{ $mark->id }}</td>
                                <td>{{ $mark->name }}</td>
                                <td width="10px">
                                    <a class="btn btn-primary btn-sm"
                                        href="{{ route('admin.marks.edit', $mark) }}">Editar</a>
                                </td>
                                <td width="10px">
                                    <form action="{{ route('admin.marks.destroy', $mark) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Eleminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        @else
            <div class="card-body">
                No hay marcas de vehículos registradas
            </div>
        @endif 
    </div> --}}
@stop