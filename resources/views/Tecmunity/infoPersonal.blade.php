@extends('main')

@section('title', 'Informacion Personal')

@section('contenido')
<div class="flex justify-center py-10">
    <div class="w-full max-w-2xl bg-white shadow-lg rounded-lg p-8">
        <div class="border-b pb-4 mb-4">
            <h3 class="text-2xl font-semibold text-center">Personal Information</h3>
        </div>
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('POST')
            <div class="flex flex-col space-y-1">
                <label for="nombre" class="font-medium">Nombre</label>
                <input type="text" name="nombre" id="nombre" value="{{ old('nombre', auth()->user()->nombre) }}" required class="border border-gray-300 rounded-lg p-2" />
            </div>
            <div class="flex flex-col space-y-1">
                <label for="apellido" class="font-medium">Apellido</label>
                <input type="text" name="apellido" id="apellido" value="{{ old('apellido', auth()->user()->apellido) }}" required class="border border-gray-300 rounded-lg p-2" />
            </div>
            <div class="flex flex-col space-y-1">
                <label for="username" class="font-medium">Username</label>
                <input type="text" name="username" id="username" value="{{ old('username', auth()->user()->username) }}" required class="border border-gray-300 rounded-lg p-2" />
            </div>
            <div class="flex flex-col space-y-1">
                <label class="font-medium">Your Email</label>
                <input type="text" value="{{ auth()->user()->email }}" readonly class="border border-gray-300 rounded-lg p-2 bg-gray-100" />
            </div>
            <div class="flex flex-col space-y-1">
                <label for="carrera_id" class="font-medium">Carrera</label>
                <select name="carrera_id" id="carrera_id" class="border border-gray-300 rounded-lg p-2">
                    @foreach($carreras as $carrera)
                        <option value="{{ $carrera->id }}" {{ old('carrera_id', auth()->user()->carrera_id) == $carrera->id ? 'selected' : '' }}>
                            {{ $carrera->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="flex flex-col space-y-1">
                <label for="fecha_nacimiento" class="font-medium">Fecha de nacimiento</label>
                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="{{ old('fecha_nacimiento', auth()->user()->fecha_nacimiento) }}" class="border border-gray-300 rounded-lg p-2" />
            </div>
            <div class="flex flex-col space-y-1">
                <label for="avatar" class="font-medium">Avatar</label>
                <input type="file" name="avatar" id="avatar" class="border border-gray-300 rounded-lg p-2" />
            </div>
            <div class="flex flex-col space-y-1">
                <label for="portada" class="font-medium">Portada</label>
                <input type="file" name="portada" id="portada" class="border border-gray-300 rounded-lg p-2" />
            </div>
            <div class="flex flex-col space-y-1">
                <label for="sexo" class="font-medium">Género</label>
                <select name="sexo" id="sexo" class="border border-gray-300 rounded-lg p-2">
                    <option value="Hombre" {{ old('sexo', auth()->user()->sexo) == 'Hombre' ? 'selected' : '' }}>Hombre</option>
                    <option value="Mujer" {{ old('sexo', auth()->user()->sexo) == 'Mujer' ? 'selected' : '' }}>Mujer</option>
                    <option value="Otro" {{ old('sexo', auth()->user()->sexo) == 'Otro' ? 'selected' : '' }}>Otro</option>
                </select>
            </div>
            <div class="flex flex-col space-y-1">
                <label for="privado" class="font-medium">Perfil</label>
                <select name="privado" id="privado" required class="border border-gray-300 rounded-lg p-2">
                    <option value="0" {{ old('privado', auth()->user()->privado) == 0 ? 'selected' : '' }}>Público</option>
                    <option value="1" {{ old('privado', auth()->user()->privado) == 1 ? 'selected' : '' }}>Privado</option>
                </select>
            </div>
            <div class="flex flex-col space-y-1">
                <label for="biografia" class="font-medium">Biografía</label>
                <textarea name="biografia" id="biografia" placeholder="Una pequeña info sobre ti..." class="border border-gray-300 rounded-lg p-2">{{ old('biografia', auth()->user()->biografia) }}</textarea>
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white rounded-lg p-2 font-medium hover:bg-blue-600">Guardar los cambios</button>
        </form>
    </div>
</div>
@endsection
