@extends('adminlte::page')

@section('title', 'Posts')

@section('content_header')
    {{-- <a class="btn btn-secondary btn-sm float-right" href="{{ route('admin.services.create') }}">Agregar Servicio</a> --}}
    <h1>Servicios Realizados por {{$employee->name}} {{$employee->last_name}}</h1>
@stop

@section('content')
    
    <div class="card">
        <div class="card-body">
            <div class="container overflow-hidden">
                {{-- <div class="row gy-5">
                  <div class="col-4 mb-2">
                    <div class="p-3 border bg-light">
                        Inicio
                        <p style="margin-bottom: 0; font-size: 20px">{{ $data['start'] }}</p>
                    </div>
                  </div>
                  <div class="col-4 mb-2">
                    <div class="p-3 border bg-light">
                        Finalizo
                        <p style="margin-bottom: 0; font-size: 20px">{{ $data['finished'] }}</p>
                    </div>
                  </div>
                  <div class="col-4 mb-2">
                    <div class="p-3 border bg-light">
                        Precio
                        <p style="margin-bottom: 0; font-size: 20px">{{ $data['price'] }}</p>
                    </div>
                  </div>
                  <div class="col-4 mb-2">
                    <div class="p-3 border bg-light">
                        Marca Vehículo
                        <p style="margin-bottom: 0; font-size: 20px">{{ $data['mark'] }}</p>
                    </div>
                  </div>
                  <div class="col-4 mb-2">
                    <div class="p-3 border bg-light">
                        Línea Vehículo
                        <p style="margin-bottom: 0; font-size: 20px">{{ $data['model'] }}</p>
                    </div>
                  </div>
                  <div class="col-4 mb-2">
                    <div class="p-3 border bg-light">
                        Placa Vehículo
                        <p style="margin-bottom: 0; font-size: 20px">{{ $data['plate'] }}</p>
                    </div>
                  </div>
                  <div class="col-4 mb-2">
                    <div class="p-3 border bg-light">
                        Color Vehículo
                        <p style="margin-bottom: 0; font-size: 20px">{{ $data['color'] }}</p>
                    </div>
                  </div>
                  <div class="col-4 mb-2">
                    <div class="p-3 border bg-light">
                        Tipo Vehículo
                        <p style="margin-bottom: 0; font-size: 20px">{{ $data['type'] }}</p>
                    </div>
                  </div>
                  <div class="col-4 mb-2">
                    <div class="p-3 border bg-light">
                        Cliente
                        <p style="margin-bottom: 0; font-size: 20px">{{ $data['client'] }}</p>
                    </div>
                  </div>
                  <div class="col-6 mb-2">
                    <div class="p-3 border bg-light">
                        Empleado
                        <p style="margin-bottom: 0; font-size: 20px">{{ $data['employee'] }}</p>
                    </div>
                  </div>
                  <div class="col-6 mb-2">
                    <div class="p-3 border bg-light">
                        Jefe Patio
                        <p style="margin-bottom: 0; font-size: 20px">{{ $data['yard'] }}</p>
                    </div>
                  </div>
                  <div class="col-12 mb-2">
                    <div class="p-3 border bg-light">
                        Inventarío del Vehículo
                        <p style="margin-bottom: 0; font-size: 20px">{{ $data['stocktaking'] }}</p>
                    </div>
                  </div>
              </div> --}}
        </div>
    </div>
    
@stop