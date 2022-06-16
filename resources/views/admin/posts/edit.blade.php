@extends('adminlte::page')

@section('title', 'Editar Post')

@section('content_header')
    <h1>Editar Post</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            {!! Form::model($post, ['route' => ['admin.posts.update', $post], 'method' => 'put', 'autocomplete' => 'off', 'files' => true]) !!}

                <div class="form-group">
                    {!! Form::label('name', 'Nombre:') !!}
                    {!! Form::text('name', $post->name, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del post']) !!}
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="row mb-3">
                    <div class="col">
                        {!! Form::label('image', 'Imagen del post') !!}
                        <div class="image-wrapper">
                            @isset($post->url_image)
                                <img width="106.66px" class="h-20 object-cover object-center" id="picture" src="{{ Storage::url($post->url_image) }}"
                                    alt="">
                            @else
                                <img id="picture" src="https://cdn.pixabay.com/photo/2019/01/28/17/00/car-wash-3960877_960_720.jpg"
                                    alt="">
                            @endisset
                        </div>
                    </div>
                </div>

                <div>
                    <div class="form-group">
                        {!! Form::label('service_id', 'Servicio:') !!}
                        <input class="form-control" value="{{$post->service->name}}" readonly>
                        @error('service_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('extract', 'Extracto:') !!}
                    {!! Form::textarea('extract', $post->extract, ['class' => 'form-control']) !!}
                    @error('extract')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('body', 'Cuerpo del post:') !!}
                    {!! Form::textarea('body', $post->body, ['class' => 'form-control']) !!}
                    @error('body')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div> 
                

                {!! Form::submit('Actualizar Post', ['class'=>'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
    
@stop

@section('css')
    <style>
        .image-wrapper {
            position: relative;
            padding-bottom: 56.25%;
        }

        .image-wrapper img {
            position: absolute;
            object-fit: cover;
            width: 100%;
            height: 100%;
        }

    </style>
@endsection