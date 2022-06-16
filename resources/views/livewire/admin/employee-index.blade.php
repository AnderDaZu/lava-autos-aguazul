<div class="card row justify-content-md-center">

    <div class="card-header row flex-auto">
        <div class="col-md-6">
            <input wire:model="search" class="form-control" placeholder="Ingrese el nombre de un empleado">
        </div>
    </div>

    @if ($employees->count())

        <div class="card-body">
            <table class="table table-striped table-hover">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>email</th>
                        <th>Telefono</th>
                        <th>Estado</th>
                        <th colspan="3"></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($employees as $employee)
                        <tr>
                            <td>{{ $employee->id }}</td>
                            <td>{{ $employee->name }} {{ $employee->last_name }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->phone }}</td>
                            
                            @if ($employee->state_id == 1)
                                <td>Activo</td>
                            @elseif($employee->state_id == 2)
                                <td>Inactivo</td>
                            @endif
                            
                            @if ($employee->horario_id == 1)
                                <td width="10px">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brightness-2" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffbf00" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <circle cx="12" cy="12" r="3" />
                                    <path d="M6 6h3.5l2.5 -2.5l2.5 2.5h3.5v3.5l2.5 2.5l-2.5 2.5v3.5h-3.5l-2.5 2.5l-2.5 -2.5h-3.5v-3.5l-2.5 -2.5l2.5 -2.5z" />
                                    </svg>
                                </td>
                            @elseif ($employee->horario_id == 2)
                                <td width="10px">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-moon" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#9e9e9e" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" />
                                    </svg>
                                </td>
                            @else
                                <td width="10px"></td>  
                            @endif

                            <td width="10px">
                                @can('admin.employees.edit')
                                    <a class="btn btn-primary btn-sm"
                                        href="{{ route('admin.employees.edit', $employee) }}">Editar</a>
                                @endcan
                            </td>
                            <td width="10px">
                                @can('admin.employees.destroy')
                                    <form action="{{ route('admin.employees.destroy', $employee) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Eleminar
                                        </button>
                                    </form>
                                @endcan

                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
        <div class="card-footer">
            {{ $employees->links() }}
        </div>
    @else
        <div class="card-body">
            No hay Empleados registrados
        </div>
    @endif
</div> 