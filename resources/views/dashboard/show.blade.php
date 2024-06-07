<x-dashboard>
    <div class="container-fluid">
        <h2 class="text-center">Detalles del Usuario</h2>

        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>ID</th>
                    <td>{{ $usuario->id }}</td>
                </tr>
                <tr>
                    <th>Nombre</th>
                    <td>{{ $usuario->nombre }}</td>
                </tr>
                <tr>
                    <th>Apellido</th>
                    <td>{{ $usuario->apellido }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $usuario->email }}</td>
                </tr>
                <tr>
                    <th>Username</th>
                    <td>{{ $usuario->username }}</td>
                </tr>
                <tr>
                    <th>Fecha de Nacimiento</th>
                    <td>{{ $usuario->fecha_nacimiento }}</td>
                </tr>
                <tr>
                    <th>Carrera</th>
                    <td>{{ $usuario->carrera }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ $usuario->status }}</td>
                </tr>
                <tr>
                    <th>Privado</th>
                    <td>{{ $usuario->privado }}</td>
                </tr>
                <tr>
                    <th>Admin</th>
                    <td>{{ $usuario->admin }}</td>
                </tr>
                <tr>
                    <th>Fecha de Creación</th>
                    <td>{{ $usuario->created_at }}</td>
                </tr>
                <!-- Agrega más detalles según sea necesario -->
            </tbody>
        </table>

        <div class="text-center">
            <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-warning">Editar</a>
            <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
            <a href="{{ route('usuarios.index') }}" class="btn btn-primary">Volver</a>
        </div>
    </div>
</x-dashboard>
