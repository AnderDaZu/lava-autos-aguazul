<div>
    <div class="form-group">
        {!! Form::label('type_vehicles', 'Tipo vehículo:') !!}
        {!! Form::select('type_vehicles', $types, null, ['class' => 'form-control', 'wire:model' => 'selectedType']) !!}
        @error('type_vehicles')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        {!! Form::label('service_id', 'Servicio:') !!}
        <select name="service_id" class="form-control">
            @foreach ($services as $service)
                <option value="{{ $service->id }}" selected>{{ $service->name }}</option>
            @endforeach
        </select>
        @error('service_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>
