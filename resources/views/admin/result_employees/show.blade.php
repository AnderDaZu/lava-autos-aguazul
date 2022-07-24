@extends('adminlte::page')

@section('title', $employee->name." ".$employee->last_name)

@section('content_header')
    {{-- <a class="btn btn-secondary btn-sm float-right" href="{{ route('admin.services.create') }}">Agregar Servicio</a> --}}
    <h1>Servicios Realizados por: {{$employee->name}} {{$employee->last_name}}</h1>
@stop

@section('content')
    
<div class="card">
  <div class="card-body">
      <div class="container overflow-hidden">
          <div class="row gy-5">
              <div class="col-4 mb-2">
                  <div class="p-3 border bg-light">
                      Total Servicios
                      <p style="margin-bottom: 0; font-size: 20px">{{ $total }}</p> 
                  </div>
              </div>
              <div class="col-4 mb-2">
                  <div class="p-3 border bg-light">
                      N° Servicios Ult. 30 Días
                      <p style="margin-bottom: 0; font-size: 20px">{{ $totalServicesMonth }}</p>
                  </div>
              </div>
              <div class="col-4 mb-2">
                  <div class="p-3 border bg-light">
                    N° Servicios Ult. 7 Días
                      <p style="margin-bottom: 0; font-size: 20px">{{ $totalServicesDay }}</p>
                  </div>
              </div>
            </div>
          </div>
      </div>
  </div>

    @if ($tasksS->count()) 
        <div class="card">
          <div class="card-body">
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                    <th>Servicio</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Tipo Vehículo</th>
                    <th>Placa Vehículo</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($tasksS as $task)
                        <tr>
                            {{-- <td>{{ $task->id }}</td> --}}
                            <td>{{ $task->service }}</td>
                            <td>{{ date('d M Y', strtotime($task->date)) }}</td>
                            <td>{{ date('h:i A', strtotime($task->date)) }}</td>
                            {{-- <td>{{ $task->appointment->service->name }}</td> --}}
                            {{-- <td>{{ date('d M Y', strtotime($task->date)) }}</td>
                            <td>{{ date('h:i A', strtotime($task->started)) }}</td> --}}
                            <td>{{ $task->type }}</td>                    
                            <td>{{ $task->plate }}</td>                    
                        </tr>
                    @endforeach
                </tbody>
            </table>
          </div>
          <div class="card-footer">
              {{ $tasksS->links() }}
          </div>
        </div>
    @else
        <div class="card-body">
            No hay servicios registrados en el sistema
        </div>
    @endif 
@stop