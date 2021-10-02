@extends('adminlte::page')

@section('title', 'Los Coches')

@section('content_header')
    <h1>Editar Servicio</h1>
@stop

@section('content')

    @include('sweetalert::alert')

    <div class="card">
        <div class="card-body">
            {!! Form::model($service, ['route'=> ['admin.services.update', $service], 'autocomplete' => 'off', 'method' => 'put']) !!}

                <div class="form-group">
                    {!! Form::label('name', 'Servicio') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese servicio']) !!}
                
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                
                </div>

                <div class="form-group">
                    {!! Form::label('price', 'Precio Servicio') !!}
                    {{-- {!! Form::number('price', ['class' => 'form-control']) !!} --}}
                    <input type="decimal" name="price" class="form-control" value="{{ old('price', $service->price)}}">
                
                    @error('price')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                
                </div>

                {!! Form::submit('Actualizar Servicio', ['class'=>'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@stop