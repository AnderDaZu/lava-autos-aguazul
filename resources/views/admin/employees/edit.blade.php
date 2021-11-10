@extends('adminlte::page')

@section('title', 'Los Coches')

@section('content_header')
    <h1>Editar Empleado</h1>
@stop

@section('content')

    @include('sweetalert::alert')

    <div class="card">
        <div class="card-body">
            {!! Form::model($employee, ['route' => ['admin.employees.update', $employee], 'autocomplete' => 'off', 'method' => 'put']) !!}

            @include('admin.partials.edit')

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

            {{-- <div class="form-group">
                {!! Form::label('horario_id', 'Horario laboral') !!}
                <br>
                @if ($start == '07:00:00')
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
                @elseif($start == '19:00:00')
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="horario_id" id="horario1" value="1">
                        <label class="form-check-label" for="horario1">
                            07:00 Am - 07:00 Pm
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="horario_id" id="horario2" value="2" checked>
                        <label class="form-check-label" for="horario2">
                            07:00 Pm - 07:00 Am
                        </label>
                    </div>
                @endif
            </div> --}}

            {!! Form::submit('Editar empleado', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@stop
