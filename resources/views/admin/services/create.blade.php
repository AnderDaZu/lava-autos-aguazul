@extends('adminlte::page')

@section('title', 'Los Coches')

@section('content_header')
    <h1>Agregar Servicio</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route'=> 'admin.services.store', 'autocomplete' => 'off']) !!}

                <div class="form-group">
                    {!! Form::label('name', 'Servicio') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese servicio']) !!}
                
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                
                </div>

                <div class="form-group">
                    {!! Form::label('price', 'Precio Servicio') !!}
                    {{-- {!! Form::text('price', null, ['class' => 'form-control', 'placeholder' => 'Ingrese servicio']) !!} --}}
                    {{-- {!! Form::number('price', 10,000, ['class' => 'form-control', 'placeholder' => 'Ingrese servicio']) !!} --}}
                    <input type="decimal" name="price" class="form-control">
                
                    @error('price')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                
                </div>

                {!! Form::submit('Agregar Servicio', ['class'=>'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@stop
