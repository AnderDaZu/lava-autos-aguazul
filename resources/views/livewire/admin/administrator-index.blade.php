<div class="card row justify-content-md-center">

    <div class="card-header row flex-auto">
        <div class="col-md-6">
            <input wire:model="search" class="form-control" placeholder="Ingrese el nombre de un administrador">
        </div>
    </div>

    @if ($users->count())

        <div class="card-body">
            <table class="table table-striped table-hover">

                @include('admin.partials.thead')

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
                                @can('admin.administrators.edit')
                                    <a class="btn btn-primary btn-sm"
                                        href="{{ route('admin.administrators.edit', $user) }}">Editar</a>
                                @endcan
                            </td>
                            <td width="10px">
                                @can('admin.administrators.destroy')
                                    <form action="{{ route('admin.administrators.destroy', $user) }}" method="POST">
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
            {{ $users->links() }}
        </div>
    @else
        <div class="card-body">
            No hay Administradores registrados
        </div>
    @endif
</div>