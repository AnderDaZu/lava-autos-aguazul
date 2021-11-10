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
                        <th colspan="2"></th>
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