@extends('adminlte::page')

@section('title', 'Los Coches')

@section('content_header')
    <h1>Crear Nuevo Administrador</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::model($administrator, ['route'=> ['admin.administrators.update', $administrator], 'autocomplete' => 'off', 'method' => 'put']) !!}

                @include('admin.administrators.partials.form')

                <div class="form-group">
                    {!! Form::label('email', 'Correo') !!}
                    {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Ingrese correo de administrador']) !!}
                
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                
                </div>

                {!! Form::submit('Editar administrador', ['class'=>'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@stop
