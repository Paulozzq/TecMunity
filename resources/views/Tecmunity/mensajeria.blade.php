@extends('main')
@section('title', 'Mensajería')
@section('contenido')
<div class="flex justify-between items-center border-b border-gray-200 px-4 py-3 bg-white dark:bg-dim-900 dark:border-gray-700">
    <h4 class="text-gray-800 dark:text-gray-100 font-bold">
       Mensajería
    </h4>
    <span class="relative inline-block text-blue-500 text-lg font-bold">
        
        Tecmunity
    </span>
</div>

<div id="friendsList" class="w-1/4 bg-gray-100 dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 p-4 ml-64"> 
    <h4 class="text-lg font-bold text-gray-800 dark:text-gray-100 mb-6 text-center">Amigos</h4>
    @if($usuarios->isEmpty())
        <div class="flex flex-col items-center justify-center h-full">
            <p class="text-lg text-gray-600 dark:text-gray-400 text-center mb-6">No tienes amigos aún.</p>
            <div class="flex flex-col items-center mt-10" style="margin-top:250px"> 
                <button onclick="openSearchModal()" class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition duration-200 flex flex-col items-center justify-center mt-6">
                    <i class="fas fa-search text-3xl mb-2"></i>
                    <span class="text-xl">Buscar personas</span>
                </button>
            </div>
        </div>
    @else
    
        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
            @foreach($usuarios as $amigo)
           
            <li class="flex items-center space-x-4 py-4 cursor-pointer" onclick="openChatPanel('{{ $amigo->nombre }} {{ $amigo->apellido }}')">
                @if(isset($amigo->avatar))
                    <img src="{{ $amigo->avatar }}" alt="Friend Avatar" class="w-10 h-10 rounded-full">
                @else
                    <img src="{{ asset('img/default-avatar.jpg') }}" alt="Friend Avatar" class="w-10 h-10 rounded-full">
                @endif
                <div class="ml-4">
                    <span class="block text-lg text-gray-800 dark:text-gray-100">{{ $amigo->nombre }} {{ $amigo->apellido }}</span>
                    <span class="block text-sm text-gray-500 dark:text-gray-400">{{ $amigo->biografia }}</span>
                </div>
            </li>
        @endforeach
        
        </ul>
        
    @endif
</div>
<div id="searchModal" class="modal">
    <div class="modal-content">
        <div class="flex justify-between items-center border-b border-gray-200 px-4 py-3">
            <h2  style="color:white" class="text-xl font-bold">Buscar Usuarios en Tecmunity</h2>

            <button id="closeModal" class="text-gray-600 hover:text-gray-800">
                <span class="material-icons">X</span>
            </button>
        </div>
        <div class="relative m-2">
            @livewire('search-usuario')
        </div>
        <div id="searchResults">
            
        </div>
    </div>
</div>

<script>
  
    document.addEventListener('DOMContentLoaded', function() {
        const closeModalBtn = document.getElementById('closeModal');
        const searchModal = document.getElementById('searchModal');

        closeModalBtn.addEventListener('click', function() {
            searchModal.classList.remove('modal-open'); /
        });
    });
</script>

<script>
   
    function openSearchModal() {
        var modal = document.getElementById('searchModal');
        modal.style.display = 'block';
    }

 
    function closeSearchModal() {
        var modal = document.getElementById('searchModal');
        modal.style.display = 'none';
    }
    function searchPeople() {
        
        var searchTerm = document.getElementById('searchInput').value;
        
        
        var searchResults = document.getElementById('searchResults');
        searchResults.innerHTML = '<p>Resultados para: ' + searchTerm + '</p>';
        
       
    }
</script>
    <div id="chatPanel" class="hidden w-full h-screen flex flex-col justify-between bg-gray-900 dark:bg-gray-900" style="height:900px">
       
        <div class="flex-grow flex flex-col items-stretch">
            <div class="bg-gray-900 dark:bg-gray-900 border border-gray-700 dark:border-gray-700 rounded-lg shadow-lg flex flex-col flex-grow">
               
                <div class="flex-grow overflow-y-auto p-4" id="chatMessages">
                  
                    <div class="flex items-center mb-2 relative z-10">
                        <img src="" alt="Avatar del amigo" class="w-8 h-8 rounded-full" id="chatFriendAvatar">
                        <span class="ml-2 font-bold text-white dark:text-gray-100" id="chatFriendName">Nombre del amigo</span>
                    </div>
                    
                    
               
                </div>
            </div>
        </div>
    <form id="messageForm" action="#" method="POST" class="p-4 border-t border-gray-700 dark:border-gray-700">
            @csrf
            <div class="flex items-center">
                <textarea name="message" id="message" rows="1" placeholder="Escribe tu mensaje aquí..." class="flex-grow min-w-0 w-full rounded-lg border border-gray-700 dark:border-gray-700 p-4 text-black dark:text-black-100 focus:outline-none focus:border-blue-400 resize-none"></textarea>
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
  
document.addEventListener('DOMContentLoaded', function () {
    const nombreAmigoSeleccionado = "Nombre del amigo seleccionado"; 
    const avatarAmigoSeleccionado = "URL-del-avatar-en-Cloudinary"; 
    document.getElementById('chatFriendName').textContent = nombreAmigoSeleccionado;
    document.getElementById('chatFriendAvatar').src = avatarAmigoSeleccionado;
    document.getElementById('chatFriendAvatar').alt = `Avatar de ${nombreAmigoSeleccionado}`;
});
</script>
<script>
    function openChatPanel(friendName) {
        document.getElementById('friendsList').classList.add('hidden');
        document.getElementById('chatPanel').classList.remove('hidden');
        document.getElementById('chatFriendName').innerText = friendName;
       
    }

    function openSearch() {
      
        alert('Implementar la búsqueda de personas aquí...');
    }
</script>

@endsection

