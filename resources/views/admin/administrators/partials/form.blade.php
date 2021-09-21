<div class="form-group">
    {!! Form::label('name', 'Nombres') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese nombres de administrador']) !!}

    @error('name')
        <span class="text-danger">{{ $message }}</span>
    @enderror

</div>

<div class="form-group">
    {!! Form::label('last_name', 'Apellidos') !!}
    {!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese apellidos de administrador']) !!}

    @error('last_name')
        <span class="text-danger">{{ $message }}</span>
    @enderror

</div>

<div class="form-group">
    {!! Form::label('birthdate', 'Fecha de nacimiento') !!}
    {!! Form::date('birthdate', null, ['class' => 'form-control','min' => '1960-12-31', 'max' => '2003-12-31']) !!}
    @error('birthdate')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

