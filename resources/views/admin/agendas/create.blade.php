@extends('adminlte::page')

@section('title', 'Los Coches')

@section('content_header')
    <h1>Crear Nueva Agenda</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.agendas.store', 'autocomplete' => 'off']) !!}

            <div class="form-group">
                @if (session('info'))
                    <span class="text-danger">{{ session('info') }}</span>
                @endif
            </div>

            <div class="row form-group">
                {!! Form::label('employee_id', 'Empleado', ['class' => 'ml-2 col-md-4 form-control']) !!}
                <select name="employee_id" class="ml-4 col-md-6 form-control">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} {{ $user->last_name }}</option>
                    @endforeach
                </select>
                @error('employee_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class=" row form-group">
                {!! Form::label('start_date', 'Fecha Inicio', ['class' => 'ml-2 col-md-4 form-control']) !!}
                {!! Form::date('start_date', null, ['class' => 'ml-4 col-md-6 form-control', 'min' => $fechaActual, 'max' => $fechaFin]) !!}
                @error('start_date')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="row form-group">
                {!! Form::label('end_date', 'Fecha Final', ['class' => 'ml-2 col-md-4 form-control']) !!}
                {!! Form::date('end_date', null, ['class' => 'ml-4 col-md-6 form-control', 'min' => $fechaInicioF, 'max' => $fechaFin]) !!}
                @error('end_date')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="row form-group">
                {!! Form::label('horario_id', 'Horario para laborar', ['class' => 'ml-2 col-md-4 form-control']) !!}
                <select name="horario_id" class="ml-4 col-md-6 form-control">
                    @foreach ($horarios as $horario)
                        @if ($horario->start_hour == '07:00:00')
                            <option value="{{ $horario->id }}">
                                {{ date('h', strtotime($horario->start_hour)) }} AM -
                                {{ date('h', strtotime($horario->end_hour)) }} PM</option>
                        @else
                            <option value="{{ $horario->id }}">
                                {{ date('h', strtotime($horario->start_hour)) }} PM -
                                {{ date('h', strtotime($horario->end_hour)) }} AM</option>
                        @endif
                        @error('horario_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    @endforeach
                </select>
                @error('horario_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            {!! Form::submit('Crear Agenda', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}

        </div>
    </div>
@stop
