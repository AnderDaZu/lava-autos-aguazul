@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <a class="btn btn-secondary btn-sm float-right" href="{{ route('admin.yardManagers.create') }}">Crea Jefe de Patio</a>
    <h1>Lista de Jefes de Patio</h1>
@stop

@section('content')
    
    @include('sweetalert::alert')

    @livewire('admin.yard-manager-index') 

    {{-- <div class="card row justify-content-md-center">

        @if ($yardManagers->count()) 
            <div class="card-body">
                <table class="table table-striped table-hover">

                    @include('admin.partials.thead')

                    <tbody>
                        @foreach ($yardManagers as $yardManager)
                            <tr>
                                <td>{{ $yardManager->id }}</td>
                                <td>{{ $yardManager->name }} {{ $yardManager->last_name }}</td>
                                <td>{{ $yardManager->email }}</td>
                                <td>{{ $yardManager->phone }}</td>
                                <td>estado</td>
                                <td width="10px">
                                    @can('admin.yardManagers.edit')
                                        <a class="btn btn-primary btn-sm"
                                            href="{{ route('admin.yardManagers.edit', $yardManager) }}">Editar</a>
                                    @endcan
                                </td>
                                <td width="10px">
                                    @can('admin.yardManagers.destroy')
                                        <form action="{{ route('admin.yardManagers.destroy', $yardManager) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm">
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
                No hay jefes de patio registrados
            </div>
        @endif 
    </div> --}}
@stop