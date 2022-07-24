@extends('adminlte::page')

@section('title', 'Servicio No Agendado')

@section('content_header')
    {{-- <a class="btn btn-secondary btn-sm float-right" href="{{ route('admin.services.create') }}">Agregar Servicio</a> --}}
    <h1>Detalle de Servicio: {{ $unscheduled_task->service['name'] }}</h1>
@stop

@section('content')
    
    <div class="card">
        <div class="card-body">
            <div class="container overflow-hidden">
                <div class="row gy-5">
                    <div class="col-4 mb-2">
                        <div class="p-3 border bg-light">
                            Fecha de Servicio
                            <p style="margin-bottom: 0; font-size: 20px">{{ date('d M Y - h:i A', strtotime($unscheduled_task['finished'])) }}</p> 
                        </div>
                    </div>
                    <div class="col-4 mb-2">
                        <div class="p-3 border bg-light">
                            Precio
                            <p style="margin-bottom: 0; font-size: 20px">$ {{ $unscheduled_task['price'] }}</p>
                        </div>
                    </div>
                    <div class="col-4 mb-2">
                        <div class="p-3 border bg-light">
                            Placa Vehículo
                            <p style="margin-bottom: 0; font-size: 20px">{{ $unscheduled_task['plate'] }}</p>
                        </div>
                    </div>
                    <div class="col-6 mb-2">
                        <div class="p-3 border bg-light">
                            Empleado
                            <p style="margin-bottom: 0; font-size: 20px">{{ $unscheduled_task->employee->name }} {{ $unscheduled_task->employee->last_name }}</p>
                         </div>
                    </div>
                    <div class="col-6 mb-2">
                        <div class="p-3 border bg-light">
                            Jefe Patio
                            <p style="margin-bottom: 0; font-size: 20px">{{ $unscheduled_task->yardManager->name }} {{ $unscheduled_task->yardManager->last_name }}</p>
                        </div>
                    </div>
                    <div class="col-4 mb-2">
                        <div class="p-3 border bg-light">
                            Tipo Vehículo
                            <p style="margin-bottom: 0; font-size: 20px">{{ $unscheduled_task->type->name }}</p>
                        </div>
                    </div>
                    <div class="col-8 mb-2">
                        <div class="p-3 border bg-light">
                            Inventarío del Vehículo
                            <p style="margin-bottom: 0; font-size: 20px">{{ $unscheduled_task['stocktaking'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@stop