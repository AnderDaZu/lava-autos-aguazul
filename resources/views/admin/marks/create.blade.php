@extends('adminlte::page')

@section('title', 'Crear Marca')

@section('content_header')
    <h1>Agregar Marca de Vehículo</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route'=> 'admin.marks.store', 'autocomplete' => 'off']) !!}

                <div class="form-group">
                    {!! Form::label('name', 'Marca') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese marca de vehículo']) !!}
                
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                
                </div>

                {!! Form::submit('Agregar Marca de Vehículo', ['class'=>'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@stop
