@extends('main')

@section('contenido')
<div class="container">
    <h1>Crear Nuevo Grupo</h1>

    <form action="{{ route('grupos.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="nombre">Nombre del Grupo</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="ID_carrera">Carrera</label>
            <select name="ID_carrera" id="ID_carrera" class="form-control" required>
                @foreach($carreras as $carrera)
                    <option value="{{ $carrera->ID_carrera }}">{{ $carrera->nombre }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Crear Grupo</button>
    </form>
    <div>
        @foreach($grupos as $grupo)
            <div style="borde-color: #00000">
                <a href="{{ Route('grupos.index', ['id' => $grupo->ID_grupos]) }}">{{ $grupo->nombre }}</a>
                <form action="{{route('grupos.join')}}" method="post">
                    @csrf
                    <input type="hidden" name="ID_grupo" value="{{ $grupo->ID_grupos }}">
                    <button type="submit">Unirme al grupo</button>
                </form>
            </div>
        @endforeach
    </div>
</div>
@endsection
