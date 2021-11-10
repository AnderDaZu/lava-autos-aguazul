<div class="card">

    <div class="card-header row flex-auto">
        <div class="col-md-6">
            <input wire:model="search" class="form-control" placeholder="Ingrese el nombre de un usuario">
        </div>
    </div>

    @if ($users->count())

        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <td>Estado</td>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }} {{ $user->last_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            @if ($user->state_id == 1)
                                <td>Activo</td>
                            @elseif($user->state_id == 2)
                                <td>Inactivo</td>
                            @endif
                            <td width="10px">
                                @can('admin.users.edit')
                                    <a class="btn btn-primary btn-sm" href="{{ route('admin.users.edit', $user) }}">Editar</a>
                                @endcan
                            </td>
                            <td width="10px">
                                @can('admin.users.destroy')
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit">Eleminar</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div> 

        <div class="card-footer">
            {{ $users->links() }}
        </div>
    @else
        <div class="card-body">
            <Strong>No hay ningún Registro</Strong>
        </div>
    @endif

</div>
