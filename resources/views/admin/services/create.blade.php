@extends('adminlte::page')

@section('title', 'Crear Servicio')

@section('content_header')
    <h1>Agregar Servicio</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route'=> 'admin.services.store', 'autocomplete' => 'off']) !!}

                @include('admin.services.partials.form')

                {!! Form::submit('Agregar Servicio', ['class'=>'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@stop
