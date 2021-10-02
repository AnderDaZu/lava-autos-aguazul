@extends('adminlte::page')

@section('title', 'Los Coches')

@section('content_header')
    <h1>Editar Tipo de Vehículo</h1>
@stop

@section('content')

    @include('sweetalert::alert')

    <div class="card">
        <div class="card-body">
            {!! Form::model($type, ['route'=> ['admin.types.update', $type], 'autocomplete' => 'off', 'method' => 'put']) !!}

                <div class="form-group">
                    {!! Form::label('name', 'Tipo Vehículo') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese tipo de vehículo']) !!}
                
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                
                </div>

                {!! Form::submit('Actualizar Tipo de Vehículo', ['class'=>'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@stop