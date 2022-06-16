@extends('adminlte::page')

@section('title', 'Posts')

@section('content_header')
    <a class="btn btn-secondary btn-sm float-right" href="{{ route('admin.posts.create') }}">Crear Post</a>
    <h1>Lista de Posts</h1>
@stop

@section('content')
    
    @include('sweetalert::alert')

    <div class="card justify-content-md-center">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                    <th class="text-center">id</th>
                    <th class="text-center">Post</th>
                    <th class="text-center">Tipo Vehículo</th>
                    <th class="text-center">Servicio</th>
                    <th class="text-center">Creador</th>
                    <th class="text-center">Fecha Creación</th>
                    <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td class="text-center">{{ $post->id }}</td>
                            <td class="text-center">{{ $post->name }}</td>
                            <td class="text-center">{{ $post->type }}</td>
                            <td class="text-center">{{ $post->service }}</td>
                            <td class="text-center">{{ $post->name_user }} {{ $post->last_name_user }}</td>
                            <td class="text-center">{{ date('Y-m-d', strtotime($post->created)) }}</td>
                            <td width="10px">
                                <a class="btn btn-primary btn-sm" href="{{ route('admin.posts.edit', $post) }}">Editar</a>
                            </td>
                            <td width="10px">
                                <form action="{{ route('admin.posts.destroy', $post) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-sm" type="submit">
                                        Eleminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
@stop