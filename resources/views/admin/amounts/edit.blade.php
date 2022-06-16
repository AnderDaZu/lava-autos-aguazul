@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    {{-- <a class="btn btn-secondary btn-sm float-right" href="{{ route('admin.types.create') }}">Crea Tipo de Vehículo</a> --}}
    <h1>Cantidad de cupos</h1>
@stop

@section('content')

    <div class="card justify-content-md-center"> 
        <div class="card-body">
            <form action="{{ route('admin.amounts.update', $amount) }}" method="post">
                @csrf
                @method('put')
                <div class="form-group">
                    <label>Cantidades de citas al mismo tiempo</label>
                    {!! Form::select('amounts', $amounts, $amount['num'], ['class' => 'form-control']) !!}
                    @error('amounts')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                {!! Form::submit('Cambiar cantidad', ['class' => 'btn btn-primary']) !!}
            </form>
        </div>
    </div>

@stop