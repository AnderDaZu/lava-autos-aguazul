<div class="card row justify-content-md-center">

    <div class="card-header row flex-auto">
        <div class="col-md-6">
            <input wire:model="search" class="form-control" placeholder="Ingrese el nombre de una línea">
        </div>
    </div>

    @if ($modelcars->count())

        <div class="card-body">
            <table class="table table-striped table-hover">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Línea</th>
                        <th>Marca</th>
                        <th>Tipo</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($modelcars as $modelcar)
                        <tr>
                            <td>{{ $modelcar->id }}</td>
                            <td>{{ $modelcar->name }}</td>
                            <td>{{ $modelcar->mark->name }}</td>
                            <td>{{ $modelcar->type->name }}</td>
                            <td width="10px">
                                @can('admin.modelcars.edit')
                                    <a class="btn btn-primary btn-sm"
                                        href="{{ route('admin.modelcars.edit', $modelcar) }}">Editar</a>
                                @endcan
                            </td>
                            <td width="10px">
                                @can('admin.modelcars.destroy')
                                    <form action="{{ route('admin.modelcars.destroy', $modelcar) }}" method="POST">
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
            {{ $modelcars->links() }}
        </div>
    @else
        <div class="card-body">
            No hay líneas registradas
        </div>
    @endif
</div>