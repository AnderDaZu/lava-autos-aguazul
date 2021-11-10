<div class="card row justify-content-md-center">

    <div class="card-header row flex-auto">
        <div class="col-md-6">
            <input wire:model="search" class="form-control" placeholder="Ingrese el nombre de una marca">
        </div>
    </div>

    @if ($marks->count())

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
                    @foreach ($marks as $mark)
                        <tr>
                            <td>{{ $mark->id }}</td>
                            <td>{{ $mark->name }}</td>
                            <td width="10px">
                                @can('admin.marks.edit')
                                    <a class="btn btn-primary btn-sm"
                                        href="{{ route('admin.marks.edit', $mark) }}">Editar</a>
                                @endcan
                            </td>
                            <td width="10px">
                                @can('admin.marks.destroy')
                                    <form action="{{ route('admin.marks.destroy', $mark) }}" method="POST">
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
        {{-- <div class="card-footer">
            {{ $types->links() }}
        </div> --}}
    @else
        <div class="card-body">
            No hay marcas registradas
        </div>
    @endif
</div>