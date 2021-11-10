<div class="card row justify-content-md-center">

    <div class="card-header row flex-auto">
        <div class="col-md-6">
            <input wire:model="search" class="form-control" placeholder="Ingrese el nombre de un jefe de patio">
        </div>
    </div>

    @if ($yardManagers->count()) 

        <div class="card-body">
            <table class="table table-striped table-hover">

                @include('admin.partials.thead')

                <tbody>
                    @foreach ($yardManagers as $yardManager)
                        <tr>
                            <td>{{ $yardManager->id }}</td>
                            <td>{{ $yardManager->name }} {{ $yardManager->last_name }}</td>
                            <td>{{ $yardManager->email }}</td>
                            <td>{{ $yardManager->phone }}</td>
                            @if ($yardManager->state_id == 1)
                                <td>Activo</td>
                            @elseif($yardManager->state_id == 2)
                                <td>Inactivo</td>
                            @endif 
                            <td width="10px">
                                @can('admin.yardManagers.edit')
                                    <a class="btn btn-primary btn-sm"
                                        href="{{ route('admin.yardManagers.edit', $yardManager) }}">Editar</a>
                                @endcan
                            </td>
                            <td width="10px">
                                @can('admin.yardManagers.destroy')
                                    <form action="{{ route('admin.yardManagers.destroy', $yardManager) }}" method="POST">
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
            {{ $yardManagers->links() }}
        </div>
    @else
        <div class="card-body">
            No hay jefes de patio registrados
        </div>
    @endif 
</div>