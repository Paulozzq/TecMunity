<x-dashboard>
  <div class="container-fluid">
    <h2 class="text-center">Lista de Denuncias</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Denunciado</th>
                    <th>Denunciante</th>
                    <th>Publicación</th>
                    <th>Contenido</th>
                    <th>Tipo</th>
                    <th>Status</th>
                    <th>Fecha de Aprobación</th>
                    <th>Fecha de Creación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($denuncias as $denuncia)
                <tr>
                    <td>{{ $denuncia->id }}</td>
                    <td>{{ $denuncia->denunciado }}</td>
                    <td>{{ $denuncia->denunciante }}</td>
                    <td>{{ $denuncia->publicacion }}</td>
                    <td>{{ $denuncia->contenido }}</td>
                    <td>{{ $denuncia->tipo }}</td>
                    <td>{{ $denuncia->status }}</td>
                    <td>{{ $denuncia->fecha_de_aprobacion }}</td>
                    <td>{{ $denuncia->created_at }}</td>
                    <td>
                        <a href="{{ route('denuncias.show', $denuncia->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <form action="{{ route('denuncias.approve', $denuncia->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success btn-sm">Aprobar</button>
                        </form>
                        <form action="{{ route('denuncias.reject', $denuncia->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-danger btn-sm">Rechazar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
  </div>

</x-dashboard>
