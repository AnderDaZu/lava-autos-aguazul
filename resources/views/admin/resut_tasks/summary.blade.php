@extends('adminlte::page')

@section('title', 'Resumen')

@section('content_header')
    {{-- <a class="btn btn-secondary btn-sm float-right" href="{{ route('admin.services.create') }}">Agregar Servicio</a> --}}
    <h1>Resumen General </h1>
    {{-- <h1>Detalle de Servicio: {{ $data['service'] }}</h1> --}}
@stop

@section('content')
    
    <div class="card">
        <div class="card-body">
            <div class="container overflow-hidden">
                <div class="row gy-5">
                    <div class="col-6 mb-2">
                        <div class="p-3 border bg-light">
                            Empleados con más Servicios Agendados en el Mes
                            @if ($tasksEmployeeS->count())
                                @foreach ($tasksEmployeeS as $employee)
                                    <p style="margin-bottom: 0; font-size: 20px">{{ $employee->name }} {{ $employee->last }}, total: {{ $employee->total }}</p>
                                @endforeach
                            @else
                                <p style="margin-bottom: 0; font-size: 20px">No hay Registros</p>                   
                            @endif
                        </div>
                    </div>
                    <div class="col-6 mb-2">
                        <div class="p-3 border bg-light">
                            Empleados con más Servicios no Agendados en el Mes
                            @if ($tasksEmployeeU->count())
                                @foreach ($tasksEmployeeU as $employee)
                                    <p style="margin-bottom: 0; font-size: 20px">{{ $employee->name }} {{ $employee->last }}, total: {{ $employee->total }}</p>
                                @endforeach
                            @else
                                <p style="margin-bottom: 0; font-size: 20px">No hay Registros</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-6 mb-2">
                        <div class="p-3 border bg-light">
                            Servicios Agendados Más Destacado 
                            @if ($tasksServiceS->count())
                                @foreach ($tasksServiceS as $service)
                                    <p style="margin-bottom: 0; font-size: 20px">{{ $service->service }} - {{ $service->type }}, total: {{ $service->total }}</p>
                                @endforeach
                            @else
                                <p style="margin-bottom: 0; font-size: 20px">No hay Registros</p>                   
                            @endif
                        </div>
                    </div>
                    <div class="col-6 mb-2">
                        <div class="p-3 border bg-light">
                            Servicio No Agendado Más Destacados
                            @if ($tasksServiceU->count())
                                @foreach ($tasksServiceU as $service)
                                    <p style="margin-bottom: 0; font-size: 20px">{{ $service->service }} - {{ $service->type }}, total: {{ $service->total }}</p>
                                @endforeach
                            @else
                                <p style="margin-bottom: 0; font-size: 20px">No hay Registros</p>                   
                            @endif
                        </div>
                    </div>
                    <div class="col-6 mb-2">
                        <div class="p-3 border bg-light">
                            Cantidad Servicios Agendados Esta Semana
                            @if (!empty($tasksDayS))
                                <p style="margin-bottom: 0; font-size: 20px">{{ $tasksDayS }}</p>
                            @else
                                <p style="margin-bottom: 0; font-size: 20px">No hay Registros</p>                   
                            @endif
                        </div>
                    </div>
                    <div class="col-6 mb-2">
                        <div class="p-3 border bg-light">
                            Cantidad Servicios No Agendados Esta Semana
                            @if (!empty($tasksDayUD))
                                <p style="margin-bottom: 0; font-size: 20px">{{ $tasksDayUD }}</p>
                            @else
                                <p style="margin-bottom: 0; font-size: 20px">No hay Registros</p>                   
                            @endif
                        </div>
                    </div>
                    <div class="col-6 mb-2">
                        <div class="p-3 border bg-light">
                            Cantidad Servicios Agendados Este Mes
                            @if (!empty($tasksMonthS))
                                <p style="margin-bottom: 0; font-size: 20px">{{ $tasksMonthS }}</p>
                            @else
                                <p style="margin-bottom: 0; font-size: 20px">No hay Registros</p>                   
                            @endif
                        </div>
                    </div>
                    <div class="col-4 mb-2">
                        <div class="p-3 border bg-light">
                            Cantidad Servicios No Agendados Este Mes
                            @if (!empty($tasksMonthUM))
                                <p style="margin-bottom: 0; font-size: 20px">{{ $tasksMonthUM }}</p>
                            @else
                                <p style="margin-bottom: 0; font-size: 20px">No hay Registros</p>                   
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@stop