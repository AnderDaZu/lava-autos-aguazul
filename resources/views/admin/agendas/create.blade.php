@extends('adminlte::page')

@section('title', 'Los Coches')

@section('content_header')
    <h1>Crear Nueva Agenda</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.agendas.store', 'autocomplete' => 'off']) !!}

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

                <div class="form-group">
                    {!! Form::label('start_date', 'Fecha inicio') !!}
                    {!! Form::date('start_date', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('end_date', 'Fecha Fin') !!}
                    {!! Form::date('end_date', null, ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('Crear Agenda', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@stop