<div class="card row justify-content-md-center">

    <div class="card-header row flex-auto">
        <div class="col-md-6">
            <input wire:model="search" class="form-control" placeholder="Ingrese fecha (ej. 2022-10-10) o nombre del empleado al cual esta asignada la cita">
        </div>
    </div>

    @if ($appointments->count())

        <div class="card-body">
            <table class="table table-striped table-hover">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Hora Inicio</th>
                        <th>Hora Fin</th>
                        <th>Empleado</th>
                        <th>Servicio</th>
                        <th>Estado</th>
                        {{-- <th colspan="2"></th> --}}
                    </tr>
                </thead>

                <tbody>
                    @foreach ($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->id }}</td>
                            <td>{{ date('Y/m/d', strtotime($appointment->date)) }}</td>
                            <td>{{ date('H:i a', strtotime($appointment->hour_start)) }}</td>
                            <td>{{ date('H:i a', strtotime($appointment->hour_end)) }}</td>
                            <td>{{ $appointment->name." ".$appointment->last_name }}</td>
                            <td>{{ $appointment->service }}</td>
                            <td>
                                @if( $appointment->date == date('Y-m-d') && $appointment->state == 'Inactivo' )
                                    <span class="bg-blue p-2 rounded-pill">Sin iniciar</span>
                                @elseif( $appointment->date == date('Y-m-d') && $appointment->state == 'Activo' )
                                    <span class="bg-green p-2 rounded-pill">Iniciada</span>
                                @elseif ( $appointment->date < date('Y-m-d') && $appointment->state == 'Inactivo' )
                                    <span class="bg-gray p-2 rounded-pill">No fue iniciada</span>
                                @elseif ( $appointment->date < date('Y-m-d') && $appointment->state == 'Activo' )
                                    <span class="bg-purple p-2 rounded-pill">Fue iniciada</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
        <div class="card-footer">
            {{ $appointments->links() }}
        </div>
    @else
        <div class="card-body">
            No hay citas registradas
        </div>
    @endif
</div>