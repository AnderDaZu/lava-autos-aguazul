@extends('adminlte::page')

@section('title', 'Los Coches')

@section('content_header')
    <h1>Editar Línea de Vehículo</h1>
@stop
 
@section('content')

    @include('sweetalert::alert')

    <div class="card"> 
        <div class="card-body">
            {!! Form::model($modelcar, ['route'=> ['admin.modelcars.update', $modelcar], 'autocomplete' => 'off', 'method' => 'put']) !!}

                <div class="form-group">
                    {!! Form::label('name', 'Línea vehículo') !!}
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

                {!! Form::submit('Actualizar Línea de Vehículo', ['class'=>'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@stop