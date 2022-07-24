@extends('adminlte::page')

@section('title', 'Editar Marca')

@section('content_header')
    <h1>Editar Marca de Vehículo</h1>
@stop

@section('content')

    @include('sweetalert::alert')

    <div class="card">
        <div class="card-body">
            {!! Form::model($mark, ['route'=> ['admin.marks.update', $mark], 'autocomplete' => 'off', 'method' => 'put']) !!}

                <div class="form-group">
                    {!! Form::label('name', 'Marca') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese marca de vehículo']) !!}
                
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                
                </div>

                {!! Form::submit('Actualizar Marca de Vehículo', ['class'=>'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@stop