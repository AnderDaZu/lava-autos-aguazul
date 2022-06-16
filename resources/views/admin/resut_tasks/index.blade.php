@extends('adminlte::page')

@section('title', 'Servicios')

@section('content_header')
    <h1>Lista de Servicios Agendados</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No. Citas Mes Actual</th>
                        <th>Servicio más Solicitado</th>
                        <th>Empleado con más Servicio</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="text-center">Fecha</th>
                        <th class="text-center">Hora Inicio</th>
                        <th class="text-center">Hora Fin</th>
                        <th class="text-center">Empleado</th>
                        <th class="text-center">Servicio</th>
                        <th width="10px"></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <td class="text-center">{{ $task->appointment->date }}</td>
                            <td class="text-center">{{ date('h:i:s A', strtotime($task->started)) }}</td>
                            <td class="text-center">{{ date('h:i:s A', strtotime($task->finished)) }}</td>
                            <td class="text-center">{{ $task->appointment->employee->name }} {{ $task->appointment->employee->last_name }}</td>
                            <td class="text-center">{{ $task->appointment->service->name }}</td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="{{ route('admin.result_task', $task) }}">Detalle</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
        </div>
    </div>
    
@stop

@section('css')
   
@endsection