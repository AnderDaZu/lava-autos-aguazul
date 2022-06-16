@extends('adminlte::page')

@section('title', 'Cupos')

@section('content_header')
    {{-- <a class="btn btn-secondary btn-sm float-right" href="{{ route('admin.types.create') }}">Crea Tipo de Vehículo</a> --}}
    <h1>Cantidad de cupos</h1>
@stop

@section('content')
    
    @include('sweetalert::alert')
    
    <div class="card justify-content-md-center">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <tbody>
                    <th width="300px">Cantidad de citas al mismo tiempo</th>
                    <td>{{ $amount->num }}</td>
                    <td>
                        <a href="{{ route('admin.amounts.edit', $amount->id) }}" class="btn btn-primary btn-sm float-right">Cambiar</a>
                    </td>
                </tbody>            
            </table>
        </div>
    </div>

@stop 