@extends('adminlte::page')

@section('title', 'Los Coches')

@section('content_header')
    <h1>Editar Jefe de Patio</h1>
@stop

@section('content')

    @include('sweetalert::alert')

    <div class="card">
        <div class="card-body">
            {!! Form::model($yardManager, ['route'=> ['admin.yardManagers.update', $yardManager], 'autocomplete' => 'off', 'method' => 'put']) !!}

            @include('admin.partials.edit')

            {!! Form::submit('Editar jefe de patio', ['class'=>'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@stop