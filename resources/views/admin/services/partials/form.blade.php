<div class="form-group">
    {!! Form::label('name', 'Servicio') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese servicio']) !!}
    @error('name')
        <span class="text-danger">{{ $message }}</span>
    @enderror

</div>

<div class="form-group">
    {!! Form::label('price', 'Precio Servicio') !!}
    {!! Form::number('price', null, ['class' => 'form-control']) !!}
    {{-- <input type="decimal" name="price" class="form-control"> --}}
    @error('price')
        <span class="text-danger">{{ $message }}</span>
    @enderror

</div>

<div class="form-group">
    {!! Form::label('duration', 'Duración del Servicio') !!}
    {!! Form::select('duration', $durations, null, ['class' => 'form-control']) !!}
    @error('duration')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('type_id', 'Tipo Vehículo') !!}
    {!! Form::select('type_id', $types, null, ['class' => 'form-control']) !!}
    @error('type_id')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>