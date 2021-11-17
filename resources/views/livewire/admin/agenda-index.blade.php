<div class="card row justify-content-md-center">

    <div class="card-header row flex-auto">
        <div class="col-md-6">
            <input wire:model="search" class="form-control" placeholder="Ingrese el nombre de un empleado o hora de inicio de agenda (07:00,19:00)">
        </div>
    </div>

    {{-- <div class="card row justify-content-md-center"> --}}

        @if ($agendas->count())
            <div class="card-body">
                <table class="table table-striped table-hover">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre Empleado</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Fin</th>
                            <th>Horario</th>
                            <th>Estado</th>
                            <th colspan="2"></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($agendas as $agenda)
                            <tr>
                                <td>{{ $agenda->id }}</td>
                                <td>{{ $agenda->employee->name }} {{ $agenda->employee->last_name }}</td>
                                <td>{{ $agenda->start_date }}</td>
                                <td>{{ $agenda->end_date }}</td>
                                @if ($agenda->horario->start_hour == '07:00:00')
                                    <td> 7:00 Am - 7:00 PM</td>
                                @elseif($agenda->horario->start_hour == '19:00:00')
                                    <td> 7:00 PM - 7:00 AM</td>
                                @endif
                                <td>
                                    @if ( $agenda->end_date <= date('Y-m-d', strtotime(now())) && $agenda->end_hour < date('H:i:s') )
                                        <span class="bg-secondary p-2 rounded-pill">Finalizada</span>
                                    @elseif ( ( $agenda->start_date <= date('Y-m-d', strtotime(now())) ) && ( $agenda->end_date >= date('Y-m-d', strtotime(now())) ) &&  ( $agenda->horario->start_hour <= date('H:i:s') ) )
                                        <span class="bg-success p-2 rounded-pill">En Proceso</span>
                                    @else    
                                        <span class="bg-info p-2 rounded-pill">Pendiente</span>
                                    @endif
                                </td>
                                <td width="10px">
                                    @can('admin.agendas.edit')
                                        <a class="btn btn-primary btn-sm"
                                            href="{{ route('admin.agendas.edit', $agenda) }}">Editar</a>
                                    @endcan
                                </td>
                                <td width="10px">
                                    @can('admin.agendas.destroy')
                                        <form action="{{ route('admin.agendas.destroy', $agenda) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm">Eleminar</button>
                                        </form>
                                    @endcan

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $agendas->links() }}
            </div>
        @else
            <div class="card-body">
                No hay agendas registradas
            </div>
        @endif 

    {{-- </div> --}}
</div> 