<div class="card row justify-content-md-center">

    <div class="card-header row flex-auto">
        <div class="col-md-6">
            <input wire:model="search" class="form-control" placeholder="Ingrese fecha o nombre del empleado al cual esta asignada la cita">
        </div>
    </div>

    @if ($appointments->count())

        <div class="card-body">
            <table class="table table-striped table-hover">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Agenda ID</th>
                        <th>Fecha</th>
                        <th>Hora inicio</th>
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
                            <td>{{ $appointment->agenda_id }}</td>
                            <td>{{ $appointment->date }}</td>
                            <td>{{ date("h:i A", strtotime($appointment->hour)) }}</td>
                            <td>{{ date("h:i A", strtotime($appointment->hour." + $appointment->duration minute")) }}</td>
                            {{-- <td>{{ $appointment->duration }}</td> --}}
                            <td>{{ $appointment->name }} {{ $appointment->last_name }}</td>
                            <td>{{ $appointment->service }}</td>
                            <td>
                                @if( $appointment->state == 'Inactivo' )
                                    <span class="bg-warning p-2 rounded-pill">Cancelada</span>
                                @elseif ( ($appointment->date < date('Y-m-d')) || ( $appointment->date === date('Y-m-d') && date('H:i', strtotime($appointment->hour."+ $appointment->duration minute")) <= date('H:i') ) )
                                    <span class="bg-secondary p-2 rounded-pill">Finalizada</span>
                                @elseif( ( $appointment->date === date('Y-m-d') ) && ( ( $appointment->hour <= date('H:i') ) &&  ( date('H:i', strtotime($appointment->hour."+ $appointment->duration minute")) > date('H:i') ) ) )
                                    <span class="bg-success p-2 rounded-pill">En Proceso</span>
                                @elseif( $appointment->date > date('Y-m-d') || ( $appointment->date === date('Y-m-d') && ( $appointment->hour > date('H:i') ) ) )
                                    <span class="bg-info p-2 rounded-pill">Pendiente</span>
                                @endif
                            </td>
                            {{-- <td width="10px">
                                <a class="btn btn-primary btn-sm" href="{{ route('admin.appointments.edit', $appointment) }}">Editar</a>
                            </td>
                            <td width="10px">
                                <form action="{{ route('admin.appointments.destroy', $appointment) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        Eleminar
                                    </button>
                                </form>
                            </td> --}}
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
            No hay citas registrados
        </div>
    @endif
</div>