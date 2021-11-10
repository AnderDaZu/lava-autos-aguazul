@extends('adminlte::page')

@section('title', 'Los Coches')

@section('content_header')
    <h1>Crear Nuevo Empleado</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.employees.store', 'autocomplete' => 'off']) !!}

            @include('admin.partials.form')

            {{-- <div class="form-group">
                {!! Form::label('horario_id', 'Horario laboral') !!}
                <br>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="horario_id" id="horario1" value="1" checked>
                    <label class="form-check-label" for="horario1">
                        07:00 Am - 07:00 Pm
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="horario_id" id="horario2" value="2">
                    <label class="form-check-label" for="horario2">
                        07:00 Pm - 07:00 Am
                    </label>
                </div>
            </div> --}}


            {!! Form::submit('Crear Empleado', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@stop
