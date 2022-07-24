@extends('adminlte::page')

@section('title', 'Crear Tipo de Vehículo')

@section('content_header')
    <h1>Agregar Tipo de Vehículo</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route'=> 'admin.types.store', 'autocomplete' => 'off']) !!}

                <div class="form-group">
                    {!! Form::label('name', 'Tipo Vehículo') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese tipo de vehículo']) !!}
                
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                
                </div>

                {!! Form::submit('Crear Tipo de Vehículo', ['class'=>'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@stop
