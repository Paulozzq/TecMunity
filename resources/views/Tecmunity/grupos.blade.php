@extends('main')

@section('title', 'Crear Nuevo Grupo')

@section('contenido')
<div class="flex justify-between items-center border-b border-gray-200 px-4 py-3 bg-white dark:bg-dim-900 dark:border-gray-700">
    <h4 class="text-gray-800 dark:text-gray-100 font-bold">
        Grupos en Tecmunity
    </h4>
    <span class="relative inline-block text-blue-500 text-lg font-bold">
        <!-- Cambiado solo el nombre de la clase a 'iconT' -->
        Tecmunity
    </span>
</div>
<br><br><br>
<div class="container mx-auto px-4 py-6">
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-white mb-2">Crear Nuevo Grupo</h1>
        
        <button onclick="openModal()" class="text-white text-2xl bg-blue-500 rounded-full p-2 hover:bg-blue-600 transition duration-200">
            <i class="fas fa-plus"></i>
        </button>

    </div>
    <div class="border-gray-300 border-t"></div>
    
    <!-- Modal -->
    <div id="createGroupModal" class="modal-bg hidden">
        <div class="modal-content bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-4">Nuevo Grupo</h2>
            <form action="{{ route('grupos.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="nombre" class="block text-white text-lg dark:text-white mb-2">Nombre del Grupo</label>
                    <input type="text"placeholder="Nombre de tu grupo nuevo" name="nombre" id="nombre" class="w-full p-2 border border-gray-300 dark:border-gray-700 rounded-lg dark:bg-gray-900 text-black-800 dark:text-black-100" required>
                </div>

                <div class="mb-4">
                    <label for="ID_carrera" class="block text-white text-lg dark:text-white mb-2">Carrera relacionada al grupo </label>
                    <select name="ID_carrera" id="ID_carrera" class="w-full p-2 border border-gray-300 dark:border-gray-700 rounded-lg dark:bg-black-900 text-black dark:text-black-100" required>
                        @foreach($carreras as $carrera)
                            <option value="{{ $carrera->ID_carrera }}">{{ $carrera->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="flex justify-end">
                    <button type="button" onclick="closeModal()" class="bg-gray-500 text-white px-4 py-2 mr-2 rounded-lg hover:bg-gray-600 transition duration-200">
                        Cancelar
                    </button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200">
                        Crear Grupo
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="border-gray-300 border-t"></div>
    
    <style>
        
    </style>
    
    <script>
        function openModal() {
            document.getElementById('createGroupModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('createGroupModal').style.display = 'none';
        }
    </script>

    <br><br>
     <div class="mt-6">
        <h2 class="text-2xl  font-bold text-gray-800 dark:text-gray-100 mb-4">Grupos Disponibles</h2> <br>
        <div class="border-gray-300 border-t"></div>
        @foreach($grupos as $grupo)
            <div class="mb-4 p-4 bg-gray-100 dark:bg-gray-800 rounded-lg shadow-md">
                <p class="text-sm text-gray-400 mt-2">Creado por: {{ $grupo->creador->nombre }}</p>
                <a href="{{ route('grupos.index', ['id' => $grupo->ID_grupos]) }}" class="text-xl font-semibold text-white dark:text-gray-100 hover:underline">{{ $grupo->nombre }}</a> <br><br>
               
                <form action="{{ route('grupos.join') }}" method="post" class="mt-2">
                    @csrf
                    <input type="hidden" name="ID_grupo" value="{{ $grupo->ID_grupos }}">
                    <button type="submit" class="button">
                        Unirme al grupo
                    </button>
                    @if(session('sweetalert'))
                         <script>
                         Swal.fire({
                             icon: 'info',
                         title: 'Información',
                         text: '{{ session('sweetalert') }}'
                             });
                        </script>
                    @endif

                </form>
                <form action="{{ route('grupos.index', ['id' => $grupo->ID_grupos]) }}" method="get" class="mt-2">
                    <button type="submit" class="button">
                        Ver Grupo
                    </button>
                </form>

                
                
                
            </div>
            <hr class="border-t border-gray-300 my-4">

        @endforeach
    </div>
</div>
@endsection
