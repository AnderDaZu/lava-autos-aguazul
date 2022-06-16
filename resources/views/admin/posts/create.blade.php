@extends('adminlte::page')

@section('title', 'Crear Post')

@section('content_header')
    {{-- <a class="btn btn-secondary btn-sm float-right" href="{{ route('admin.services.create') }}">Agregar Servicio</a> --}}
    <h1>Crear Post</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.posts.store', 'autocomplete' => 'off', 'files' => true]) !!}

                <div class="form-group">
                    {!! Form::label('name', 'Nombre:') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del post']) !!}
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="row mb-3">
                    <div class="col">
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
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('file', 'Imagen que se mostrará en el post') !!}
                            <br>
                            {!! Form::file('file', ['class' => 'fomr-control-file', 'accept' => 'image/*']) !!}
                            @error('file')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                @livewire('admin.post-create')

                <div class="form-group">
                    {!! Form::label('extract', 'Extracto:') !!}
                    {!! Form::textarea('extract', null, ['class' => 'form-control']) !!}
                    @error('extract')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('body', 'Cuerpo del post:') !!}
                    {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
                    @error('body')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div> 
                

                {!! Form::submit('Crear Post', ['class'=>'btn btn-primary']) !!}

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

@section('js')
    <script>
        // Cambiar imagen
        document.getElementById("file").addEventListener('change', cambiarImagen);

        function cambiarImagen(event) {
            var file = event.target.files[0];

            var reader = new FileReader();
            reader.onload = (event) => {
                document.getElementById("picture").setAttribute('src', event.target.result);
            };

            reader.readAsDataURL(file);
        }
    </script>
@endsection