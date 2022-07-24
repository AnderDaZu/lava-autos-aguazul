@extends('adminlte::page')

@section('title', 'Editar Usuario')

@section('content_header')
    <h1>Editar Usuario</h1>
@stop

@section('content')

    @include('sweetalert::alert')

    <div class="card">
        <div class="card-body">
            {!! Form::model($user, ['route' => ['admin.users.update', $user], 'autocomplete' => 'off', 'method' => 'put']) !!}

                <div class="form-group">
                    {!! Form::label('name', 'Nombres') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese nombres de administrador', 'readonly']) !!}

                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                </div>

                <div class="form-group">
                    {!! Form::label('last_name', 'Apellidos') !!}
                    {!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese apellidos de administrador', 'readonly']) !!}

                    @error('last_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                </div>

                <div class="form-group">
                    {!! Form::label('birthdate', 'Fecha de nacimiento') !!}
                    {!! Form::date('birthdate', null, ['class' => 'form-control', 'min' => '1960-12-31', 'max' => '2003-12-31', 'readonly']) !!}
                    @error('birthdate')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('identification', 'Documento de Identidad') !!}
                    {!! Form::text('identification', null, ['class' => 'form-control', 'placeholder' => 'Ingrese número de identificación', 'readonly']) !!}
                    @error('identification')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('phone', 'Número Celular') !!}
                    {!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'Ingrese número de celular', 'readonly']) !!}
                    @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('email', 'Correo') !!}
                    {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Ingrese correo de administrador']) !!}

                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <p class="font-weight-bold">Estado</p>
                    <label class="mr-2">
                        {!! Form::radio('state_id', 1) !!}
                        Activo
                    </label>
                    <label>
                        {!! Form::radio('state_id', 2) !!}
                        Inactivo
                    </label>
                    @error('state_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                
                {!! Form::submit('Editar Usuario', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@stop
