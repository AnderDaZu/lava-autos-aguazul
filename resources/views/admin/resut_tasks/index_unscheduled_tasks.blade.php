@extends('adminlte::page')

@section('title', 'Servicios')

@section('content_header')
    <h1>Lista de Servicios No Agendados</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>N° Servicios Ult. 30 Días</th>
                        <th>Servicio más Solicitado</th>
                        <th>Empleado con más Servicios</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @if (!empty($tasksMonth))
                            <td>{{ $tasksMonth }}</td>
                        @else
                            <td></td>
                        @endif
                        @if (!empty($tasksService))
                            <td>{{ $tasksService->service }} - {{ $tasksService->type }}, total: {{ $tasksService->total }}</td>
                        @else
                            <td></td>
                        @endif
                        @if (!empty($tasksEmployee))
                            <td>{{ $tasksEmployee->name }} {{ $tasksEmployee->last }}, total: {{ $tasksEmployee->total }}</td>
                        @else
                            <td></td>
                        @endif
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    @if ($tasks->count())
        <div class="card">
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">Fecha</th>
                            <th class="text-center">Hora Fin</th>
                            <th class="text-center">Empleado(a)</th>
                            <th class="text-center">Servicio</th>
                            <th width="10px"></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <td class="text-center">{{ date('d M Y', strtotime($task->finished)) }}</td>
                                <td class="text-center">
                                    {{ date('h:i A', strtotime($task->finished)) }}
                                </td>
                                <td class="text-center">{{ $task->employee->name }} {{ $task->employee->last_name }}</td>
                                <td class="text-center">{{ $task->service->name }}</td>
                                <td>
                                    <a class="btn btn-sm btn-primary" href="{{ route('admin.result_unscheduled_task.show', $task) }}">Detalle</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $tasks->links() }}
            </div>
        </div>        
    @else
        <div class="card-body">
            Aún no hay servicios no registrados en el sistema
        </div>
    @endif


    
@stop
 
@section('css')
   
@endsection