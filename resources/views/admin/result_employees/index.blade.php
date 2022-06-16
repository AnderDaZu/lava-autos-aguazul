@extends('adminlte::page')

@section('title', 'Servicios')

@section('content_header')
    <h1>Empleados</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            <label>No. Empleados</label>
        </div>        
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-hover">

                <thead>
                    <tr>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Apellido</th>
                        <th class="text-center">No. Servicios</th>
                        <th width="10px"></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($employees as $employee)
                        <tr>
                            <td class="text-center">{{ $employee->name }}</td>
                            <td class="text-center">{{ $employee->last_name }}</td>
                            <td class="text-center">{{ count($employee->employeeAppointments) }}</td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="{{ route('admin.result_employee', $employee) }}">Ver</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
    
@stop

@section('css')
   
@endsection