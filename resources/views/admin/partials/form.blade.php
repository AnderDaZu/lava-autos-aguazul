<div class="form-group">
    {!! Form::label('user_name', 'User Name') !!}
    {!! Form::text('user_name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese user name de administrador']) !!}

    @error('user_name')
        <span class="text-danger">{{ $message }}</span>
    @enderror

</div>

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
    {!! Form::date('birthdate', null, ['class' => 'form-control', 'min' => '1960-12-31', 'max' => '2003-12-31']) !!}
    @error('birthdate')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">

    {!! Form::label('identification', 'Documento de Identidad') !!}

    <div class="input-group">
        <i class="input-group-text">
            <i class="fas fa-address-card"></i>
        </i>
        {!! Form::text('identification', null, ['class' => 'form-control', 'placeholder' => 'Ingrese número de identificación']) !!}
    </div>

    @error('identification')
        <span class="text-danger">{{ $message }}</span>
    @enderror

</div>

<div class="form-group">

    {!! Form::label('phone', 'Número Celular') !!}

    <div class="input-group">
        <i class="input-group-text">
            <i class="fas fa-phone-alt"></i>
        </i>
        {!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'Ingrese número de celular']) !!}
    </div>

    @error('phone')
        <span class="text-danger">{{ $message }}</span>
    @enderror

</div>

<div class="form-group">

    {!! Form::label('email', 'Correo') !!}

    <div class="input-group">
        <i class="input-group-text">
            <i class="fas fa-at"></i>
        </i>
        {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Ingrese correo de administrador']) !!}
    </div>

    @error('email')
        <span class="text-danger">{{ $message }}</span>
    @enderror

</div>

<div class="form-group">
    {!! Form::label('password', 'Contraseña') !!}

    <div class="input-group">
        <i class="input-group-text">
            <i class="fas fa-key"></i>
        </i>
        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => '********']) !!}
    </div>

    @error('password')
        <span class="text-danger">{{ $message }}</span>
    @enderror

</div>

<div class="form-group">
    {!! Form::label('status', 'Estado') !!}
    <br>
    <div class="input-group">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" id="status1" value="1" checked>
            <label class="form-check-label" for="status1">
                Activo
            </label>
        </div>
        <div class="form-check ml-4">
            <input class="form-check-input" type="radio" name="status" id="status2" value="2">
            <label class="form-check-label" for="status2">
                Inactivo
            </label>
        </div>
    </div>
</div>
