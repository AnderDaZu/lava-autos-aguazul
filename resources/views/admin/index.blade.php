@extends('adminlte::page')

@section('title', 'Panel Administrativo')

@section('content')

    <div class="p-3">
        <article class="dimension" style="background-image: url(https://admin.idaoffice.org/wp-content/uploads/2018/11/%D0%BA%D0%BE%D0%BD%D1%82%D0%B0%D0%BA%D1%82%D0%BD%D0%B0%D1%8F-1.jpg)">
        
            <div class="caja">
                <h1 class="centrar">Area Administrativa<br><span class="span">Lava Autos Aguazul</span></h1>
            </div>            

        </article>
    </div>
  
    </article>

@stop

@section('footer')
    <p class="text-center m-0">Todos los derechos reservados - Lava Autos Aguazul 2022</p>
@endsection

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style>
        .centrar {
            text-align: center;
            font-weight: 400;
            color: rgb(225, 235, 255);
            margin: 0;
            padding: 10px;
            width: 100%;
            background-color: rgba(1, 61, 139, 0.685);
        }

        .span {
            font-weight: 700;
            text-transform: uppercase;
        }
        .caja {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            /* background-color: rgba(200, 200, 238, 0.342); */
            border-radius: inherit
        }

        .dimension {
            width: 100%;
            height: 480px;
            background-size: cover;
            background-position: center;
            border-radius: 5px;
        }
    </style>
@stop