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

                @include('admin.services.partials.form')

                {!! Form::submit('Actualizar Servicio', ['class'=>'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@stop