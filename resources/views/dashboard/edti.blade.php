<x-dashboard>
    <div class="container-fluid">
        <h2 class="text-center">Editar Usuario</h2>

        <form action="{{ route('usuarios.update', $usuario->id) }}"
method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control"
value="{{ $usuario->nombre }}">
            </div>
            <div class="form-group">
                <label for="apellido">Apellido</label>
                <input type="text" name="apellido"
class="form-control" value="{{ $usuario->apellido }}">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control"
value="{{ $usuario->email }}">
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username"
class="form-control" value="{{ $usuario->username }}">
            </div>
            <div class="form-group">
                <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                <input type="date" name="fecha_nacimiento"
class="form-control" value="{{ $usuario->fecha_nacimiento }}">
            </div>
            <div class="form-group">
                <label for="carrera">Carrera</label>
                <input type="text" name="carrera" class="form-control"
value="{{ $usuario->carrera }}">
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <input type="text" name="status" class="form-control"
value="{{ $usuario->status }}">
            </div>
            <div class="form-group">
                <label for="privado">Privado</label>
                <input type="text" name="privado" class="form-control"
value="{{ $usuario->privado }}">
            </div>
            <div class="form-group">
                <label for="admin">Admin</label>
                <input type="text" name="admin" class="form-control"
value="{{ $usuario->admin }}">
            </div>
            <button type="submit" class="btn btn-success">Guardar
cambios</button>
            <a href="{{ route('usuarios.index') }}" class="btn
btn-primary">Volver</a>
        </form>
    </div>
</x-dashboard>