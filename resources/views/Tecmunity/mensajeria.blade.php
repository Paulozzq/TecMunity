@extends('main')
@section('title', 'Mensajería')
@section('contenido')
<div class="flex justify-between items-center border-b border-gray-200 px-4 py-3 sticky top-0 bg-white dark:bg-dim-900 dark:border-gray-700">
    <h4 class="text-gray-800 dark:text-gray-100 font-bold">
       Mensajería
    </h4>
    <i class="fab fa-twitter text-lg text-blue-400"></i> <!-- Font Awesome Twitter icon -->
</div>
<div id="friendsList" class="w-1/4 bg-gray-100 dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 p-4 ml-64"> <!-- Increased ml-64 for a much larger left margin -->
    <h4 class="text-lg font-bold text-gray-800 dark:text-gray-100 mb-6 text-center">Amigos</h4>
    @if($usuarios->isEmpty())
        <div class="flex flex-col items-center justify-center h-full">
            <p class="text-lg text-gray-600 dark:text-gray-400 text-center mb-6">No tienes amigos aún.</p>
            <div class="flex flex-col items-center mt-10" style="margin-top:250px"> <!-- Added mt-10 for more space above the button -->
                <button onclick="openSearchModal()" class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition duration-200 flex flex-col items-center justify-center mt-6">
                    <i class="fas fa-search text-3xl mb-2"></i>
                    <span class="text-xl">Buscar personas</span>
                </button>
            </div>
        </div>
    @else
        <!-- List of friends -->
        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
            @foreach($usuarios as $amigo)
            <!-- Example friend item -->
            <li class="flex items-center space-x-4 py-4">
                @if(isset($amigo->avatar))
                    <img src="{{ $amigo->avatar }}" alt="Friend Avatar" class="w-10 h-10 rounded-full">
                @else
                    <img src="{{ asset('img/default-avatar.jpg') }}" alt="Friend Avatar" class="w-10 h-10 rounded-full">
                @endif
                <span class="text-lg text-gray-800 dark:text-gray-100">{{ $amigo->nombre }} {{ $amigo->apellido }}</span>
            </li>
            @endforeach
        </ul>
    @endif
</div>
<div id="searchModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeSearchModal()">&times;</span>
        <h2>Buscar personas</h2>
        <!-- Formulario de búsqueda -->
        <form id="searchForm" onsubmit="return false;">
            <input type="text" id="searchInput" placeholder="Buscar por nombre...">
            <button onclick="searchPeople()" class="search-btn">Buscar</button>
        </form>
        
        <!-- Resultados de búsqueda (pueden ser dinámicos según el resultado) -->
        <div id="searchResults">
            <!-- Aquí se mostrarán los resultados de búsqueda -->
        </div>
    </div>
</div>


<script>
    // Función para abrir el modal
    function openSearchModal() {
        var modal = document.getElementById('searchModal');
        modal.style.display = 'block';
    }

    // Función para cerrar el modal
    function closeSearchModal() {
        var modal = document.getElementById('searchModal');
        modal.style.display = 'none';
    }

    // Función para buscar personas
    function searchPeople() {
        // Obtener el valor del campo de búsqueda
        var searchTerm = document.getElementById('searchInput').value;
        
        // Aquí puedes implementar la lógica de búsqueda
        // Por ejemplo, podrías enviar una solicitud AJAX para buscar personas
        
        // Ejemplo de muestra de resultados (simulado)
        var searchResults = document.getElementById('searchResults');
        searchResults.innerHTML = '<p>Resultados para: ' + searchTerm + '</p>';
        
        // Aquí podrías agregar lógica para mostrar los resultados reales obtenidos
        // y actualizar el contenido de searchResults dinámicamente.
    }
</script>




   
    
    
    

    <!-- Right Side - Messaging Panel -->
    <!-- HTML con Tailwind CSS -->
<div id="chatPanel" class="w-full h-screen flex flex-col justify-between bg-gray-900 dark:bg-gray-900">
    <!-- Contenido del chat -->
    <div class="flex-grow flex flex-col items-stretch">
        <div class="bg-gray-900 dark:bg-gray-900 border border-gray-700 dark:border-gray-700 rounded-lg shadow-lg flex flex-col flex-grow">
            <!-- Área de mensajes -->
            <div class="flex-grow overflow-y-auto p-4" id="chatMessages">
                <!-- Mostrar mensajes aquí -->
                <div class="flex items-center mb-2">
                    <img src="friend-avatar.jpg" alt="Avatar del amigo" class="w-8 h-8 rounded-full" id="chatFriendAvatar">
                    <span class="ml-2 font-bold text-white dark:text-gray-100" id="chatFriendName">Nombre del amigo</span>
                </div>
                <!-- Repetir para cada mensaje -->
            </div>
        </div>
    </div>

    <!-- Formulario de entrada de mensajes -->
    <form id="messageForm" action="#" method="POST" class="p-4 border-t border-gray-700 dark:border-gray-700">
        @csrf
        <div class="flex items-center">
            <textarea name="message" id="message" rows="1" placeholder="Escribe tu mensaje aquí..." class="flex-grow min-w-0 w-full rounded-lg border border-gray-700 dark:border-gray-700 p-4 text-white dark:text-gray-100 focus:outline-none focus:border-blue-400 resize-none"></textarea>
            <div class="flex items-center">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 ml-2 rounded-lg hover:bg-blue-600 transition duration-200">
                    <i class="fas fa-paper-plane"></i>
                </button>
                <button type="button" class="bg-gray-500 text-white px-4 py-2 ml-2 rounded-lg hover:bg-gray-600 transition duration-200">
                    <i class="fas fa-image"></i>
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    // Ejemplo de JavaScript para actualizar dinámicamente el nombre y avatar del amigo
    document.addEventListener('DOMContentLoaded', function () {
        // Simula la selección de un amigo
        const nombreAmigoSeleccionado = "Nombre del amigo seleccionado"; // Aquí deberías obtener dinámicamente el nombre del amigo seleccionado
        const avatarAmigoSeleccionado = "friend-avatar.jpg"; // Aquí deberías obtener dinámicamente el URL del avatar del amigo seleccionado
        
        // Actualiza el contenido del span con el nombre del amigo seleccionado
        document.getElementById('chatFriendName').textContent = nombreAmigoSeleccionado;
        
        // Actualiza el src del img con el avatar del amigo seleccionado
        document.getElementById('chatFriendAvatar').src = avatarAmigoSeleccionado;
        document.getElementById('chatFriendAvatar').alt = `Avatar de ${nombreAmigoSeleccionado}`;
    });
</script>

    
    
    

<script>
    function openChatPanel(friendName) {
        document.getElementById('friendsList').classList.add('hidden');
        document.getElementById('chatPanel').classList.remove('hidden');
        document.getElementById('chatFriendName').innerText = friendName;
        // Aquí podrías cargar los mensajes del amigo seleccionado si lo deseas
        // Ejemplo: fetchMessagesForFriend(friendName);
    }

    function openSearch() {
        // Aquí puedes redirigir al usuario a la página de búsqueda de personas
        // Puedes usar una ruta de Laravel para la búsqueda o un enlace directo
        alert('Implementar la búsqueda de personas aquí...');
    }
</script>

@endsection

