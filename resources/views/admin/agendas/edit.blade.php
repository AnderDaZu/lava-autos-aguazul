@extends('adminlte::page')

@section('title', 'Los Coches')

@section('content_header')
    <h1>Editar Agenda</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::model($agenda,['route' => ['admin.agendas.update', $agenda], 'autocomplete' => 'off', 'method' => 'put']) !!}

            <div class="form-group">
                @if (session('info'))
                    <span class="text-danger">{{ session('info') }}</span>
                @endif
            </div>

            <div class="row form-group">
                {!! Form::label('employee_id', 'Empleado', ['class' => 'ml-2 col-md-4 form-control']) !!}
                {!! Form::text('employee_id', $agenda->employee->name." ".$agenda->employee->last_name, ['class' => 'ml-4 col-md-6 form-control', 'readonly']) !!}
                @error('employee_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class=" row form-group">
                {!! Form::label('start_date', 'Fecha Inicio', ['class' => 'ml-2 col-md-4 form-control']) !!}
                {!! Form::date('start_date', $agenda->start_date, ['class' => 'ml-4 col-md-6 form-control', 'readonly']) !!}                    
                @error('start_date')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="row form-group">
                {!! Form::label('end_date', 'Fecha Final', ['class' => 'ml-2 col-md-4 form-control']) !!}
                @if ($agenda->end_date < $fechaActual)
                    {!! Form::date('end_date', $agenda->end_date, ['class' => 'ml-4 col-md-6 form-control', 'readonly']) !!}
                @else
                    {!! Form::date('end_date', $agenda->end_date, ['class' => 'ml-4 col-md-6 form-control', 'min' => $minFecha, 'max' => $agenda->end_date]) !!}
                @endif
                @error('end_date')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="row form-group">
                {!! Form::label('horario_id', 'Horario para laborar', ['class' => 'ml-2 col-md-4 form-control']) !!}

                <select name="horario_id" class="ml-4 col-md-6 form-control" readonly>
                    @if ($agenda->horario->start_hour == '07:00:00')
                        <option value="{{ $agenda->horario->id }}">
                            {{ date('h', strtotime($agenda->horario->start_hour)) }} AM -
                            {{ date('h', strtotime($agenda->horario->end_hour)) }} PM</option>
                    @else
                        <option value="{{ $agenda->horario->id }}">
                            {{ date('h', strtotime($agenda->horario->start_hour)) }} PM -
                            {{ date('h', strtotime($agenda->horario->end_hour)) }} AM</option>
                    @endif
                </select>
                @error('horario_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            @if ($agenda->end_date > $fechaActual)
                {!! Form::submit('Editar Agenda', ['class' => 'btn btn-primary']) !!}
            @endif

            {!! Form::close() !!}

        </div>
    </div>
@stop