<div class="form-group">
    {!! Form::label('name', 'Nombres') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese nombres']) !!}

    @error('name')
        <span class="text-danger">{{ $message }}</span>
    @enderror

</div>

<div class="form-group">
    {!! Form::label('last_name', 'Apellidos') !!}
    {!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese apellidos']) !!}

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

<div class="form-group">
    {!! Form::label('identification', 'Documento de Identidad') !!}
    {!! Form::text('identification', null, ['class' => 'form-control', 'placeholder' => 'Ingrese número de identificación']) !!}
    @error('identification')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('phone', 'Número Celular') !!}
    {!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'Ingrese número']) !!}
    @error('phone')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('email', 'Correo') !!}
    {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Ingrese correo']) !!}

    @error('email')
        <span class="text-danger">{{ $message }}</span>
    @enderror

</div>

<div class="form-group">
    <p class="font-weight-bold">Estado</p>
    <label class="mr-2">
        {!! Form::radio('state_id', 1, true) !!}
        Activo
    </label>
    <label>
        {!! Form::radio('state_id', 2) !!}
        Inactivo
    </label>
    @error('state_id')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>