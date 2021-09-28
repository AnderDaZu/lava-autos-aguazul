@extends('adminlte::page')

@section('title', 'Los Coches')

@section('content_header')
    <h1>Crear Jefe de Patio</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route'=> 'admin.yardManagers.store', 'autocomplete' => 'off']) !!}

                @include('admin.partials.form')

                {!! Form::submit('Crear Jefe de Patio', ['class'=>'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@stop
