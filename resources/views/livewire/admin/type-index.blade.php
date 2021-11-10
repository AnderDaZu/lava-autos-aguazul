<div class="card row justify-content-md-center">

    <div class="card-header row flex-auto">
        <div class="col-md-6">
            <input wire:model="search" class="form-control" placeholder="Ingrese el nombre de un tipo de vehículo">
        </div>
    </div>

    @if ($types->count())

        <div class="card-body">
            <table class="table table-striped table-hover">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($types as $type)
                        <tr>
                            <td>{{ $type->id }}</td>
                            <td>{{ $type->name }}</td>
                            <td width="10px">
                                @can('admin.types.edit')
                                    <a class="btn btn-primary btn-sm"
                                        href="{{ route('admin.types.edit', $type) }}">Editar</a>
                                @endcan
                            </td>
                            <td width="10px">
                                @can('admin.types.destroy')
                                    <form action="{{ route('admin.types.destroy', $type) }}" method="POST">
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
            {{ $types->links() }}
        </div>
    @else
        <div class="card-body">
            No hay tipos de vehículos registrados
        </div>
    @endif
</div>