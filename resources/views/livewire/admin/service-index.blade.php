<div class="card row justify-content-md-center">

    <div class="card-header row flex-auto">
        <div class="col-md-6">
            <input wire:model="search" class="form-control" placeholder="Ingrese el nombre de un servicio">
        </div>
    </div>

    @if ($services->count())

        <div class="card-body">
            <table class="table table-striped table-hover">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tipo</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($services as $service)
                        <tr>
                            <td>{{ $service->id }}</td>
                            <td>{{ $service->type->name }}</td>
                            <td>{{ $service->name }}</td>
                            <td>{{ $service->price }}</td>
                            <td width="10px">
                                @can('admin.services.edit')
                                    <a class="btn btn-primary btn-sm"
                                        href="{{ route('admin.services.edit', $service) }}">Editar</a>
                                @endcan
                            </td>
                            <td width="10px">
                                @can('admin.services.destroy')
                                    <form action="{{ route('admin.services.destroy', $service) }}" method="POST">
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
            {{ $services->links() }}
        </div>
    @else
        <div class="card-body">
            No hay servicios registrados
        </div>
    @endif
</div>