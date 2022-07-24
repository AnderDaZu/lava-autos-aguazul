@extends('adminlte::page')

@section('title', 'Crear Línea')

@section('content_header')
    <h1>Agregar Línea de Vehículo</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route'=> 'admin.modelcars.store', 'autocomplete' => 'off']) !!}

                <div class="form-group">
                    {!! Form::label('name', 'Línea Vehículo') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese línea de vehículo']) !!}
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('mark_id', 'Marca:') !!}
                    {!! Form::select('mark_id', $marks, null, ['class' => 'form-control']) !!}
                    @error('mark_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('type_id', 'Tipo vehículo:') !!}
                    {!! Form::select('type_id', $types, null, ['class' => 'form-control']) !!}
                    @error('type_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {!! Form::submit('Agregar Línea de Vehículo', ['class'=>'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@stop
