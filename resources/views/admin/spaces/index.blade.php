@extends('adminlte::page')

@section('title', 'Espacios')

@section('content_header')
    
    {{-- @if ( date('H:i:s', strtotime('19:00:00')) >= '19:00:00' ) --}}
    @if ( date('H:i:s') >= '19:00:00' )
        <form action="{{ route('admin.spaces.update') }}" method="POST">
            @csrf
            @method('put')
            {!! Form::submit('Reiniciar Espacios', ['class' => 'btn btn-primary btn-sm float-right']) !!}
        </form>
    @endif
    
    <h1>Espacios</h1>
@stop

@section('content')
    
    @include('sweetalert::alert')
    
    <div class="card justify-content-md-center">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                    <th class="text-center">id</th>
                    <th class="text-center">Hora Inicio</th>
                    <th class="text-center">Hora Fin</th>
                    <th class="text-center">Cantidad Tomada</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($spaces as $space)
                        <tr>
                            <td class="text-center">{{ $space->id }}</td>
                            <td class="text-center">{{ $space->start_hour }}</td>
                            <td class="text-center">{{ $space->end_hour }}</td>
                            <td class="text-center">{{ $space->times_taken }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
 
@stop 