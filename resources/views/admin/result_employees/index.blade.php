@extends('adminlte::page')

@section('title', 'Empleados')

@section('content_header')
    <h1>Empleados</h1>
@stop

@section('content')

    <div class="card"> 

        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="text-center">N° Empleados Activos</th>
                        <th class="text-center">N° Empleados Día</th>
                        <th class="text-center">N° Empleados Noche</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td  class="text-center">{{ $employeesActive }}</td>
                        <td  class="text-center">{{ $employeesMorning }}</td>
                        <td  class="text-center">{{ $employeesEvening }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    @if ($employees->count())
        <div class="card">
            <div class="card-body">
                <table class="table table-striped table-hover">

                    <thead>
                        <tr>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Apellido</th>
                            <th class="text-center">Turno</th>
                            <th class="text-center">Total Servicios</th>
                            <th width="10px"></th>
                        </tr>
                    </thead>

                    <tbody> 
                        @foreach ($employees as $employee)
                            <tr>
                                <td class="text-center">{{ $employee->name }}</td>
                                <td class="text-center">{{ $employee->last_name }}</td>
                                <td class="text-center">
                                    @if ( $employee->horario->start_hour >= '07:00:00' && $employee->horario->start_hour < '19:00:00' )
                                        Día
                                    @else
                                        Noche
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if (isset($total[$employee->id]))
                                        {{ $total[$employee->id]['total'] }}    
                                    @else
                                        0
                                    @endif
                                    {{-- {{ count($employee->employeeAppointments) }} --}}
                                </td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ route('admin.result_employee', $employee) }}">Ver</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $employees->links() }}
            </div>
        </div>
    @else
        <div class="card-body">
            No hay Empleados registrados en el sistema
        </div>
    @endif
    
@stop

@section('css')
   
@endsection