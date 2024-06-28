<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TecMunity')</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

     
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    @vite('public/js/app.js')
    @vite('public/css/dist.css')
    <style>
        .modal {
    display: none; /* Oculto por defecto */
    position: fixed; /* Fijo en la ventana */
    z-index: 1; /* Z-index alto para estar sobre otros elementos */
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto; /* Permite desplazar si el contenido es demasiado largo */
    background-color: rgba(0, 0, 0, 0.5); /* Fondo oscuro semi-transparente */
}

.modal-content {
    background-color: #1a202c;
    margin: 15% auto; /* Centrado vertical y horizontal */
    padding: 20px;
    border: 1px solid #1a202c;
    width: 80%; /* Ancho del modal */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}
    </style>
</head>
<body class="bg-white dark:bg-dim-900">
<!-- Container -->
<div class="container mx-auto h-screen flex xl:max-w-[1200px]">
    <!-- Left -->
    <div class="xl:w-1/5 w-20 h-full flex flex-col xl:pr-4">
        <!-- Logo -->
        <a href="" class="link-active my-2">
            <i class="fa-brands fa-twitter text-4xl"></i>
        </a>
        <!-- Nav -->
        <nav class="mt-5">
            <a href="{{ route('publicaciones.index') }}" class="link-active mb-8">
                <i class="fa-solid fa-house text-xl"></i>
                <span class="icon">Inicio</span>
            </a>
            <a href="{{route('notificaciones.index')}}" class="link mb-8">
                <i class="fa-solid fa-bell text-xl"></i>
                <span class="icon">Notificaciones</span>
            </a>
            <a href="{{route('mensajeria.index')}}" class="link mb-8">
                <i class="fa-solid fa-envelope text-xl"></i>
                <span class="icon">Mensajeria</span>
            </a>
            <a href="" class="link mb-8">
                <i class="fa-solid fa-list-ul text-xl"></i>
                <span class="icon">Grupos</span>
            </a>
            <a href="{{route('perfil.show', ['id'=>Auth()->user()->id])}}" class="link mb-8">
                <i class="fa-solid fa-user text-xl"></i>
                <span class="icon">Perfil</span>
            </a>
            <a href="{{ route('logout') }}" class="link mb-8">
                <i class="fa-solid fa-ellipsis text-xl"></i>
                <span class="icon">Salir</span>
            </a>
        </nav>
        <!-- Button -->
        <button id="openModal" class="mx-auto w-11 h-11 xl:w-full flex items-center justify-center bg-blue-400 rounded-full text-white font-bold">
            <i class="fas fa-feather text-xl block xl:hidden"></i>
            <span class="icon xl:ml-0">Post</span>
        </button>        <br>
        <!-- User -->
        <a href="{{ route('perfil.show', ['id' => auth()->user()->id]) }}" class="w-14 xl:w-full mx-auto mt-auto flex justify-between mb-2 rounded-full p-2 cursor-pointer">
            @if(auth()->user()->avatar)
                <img id="profile_pic" class="w-10 h-10 rounded-full" src="{{ auth()->user()->avatar }}"/>
            @else
                <img id="profile_pic" class="w-10 h-10 rounded-full" src="{{ asset('img/default-avatar.jpg') }}"/>
            @endif
            <div class="hidden xl:flex flex-col">
                <h4 class="text-gray-800 dark:text-white font-bold text-sm">{{ auth()->user()->nombre }} {{ auth()->user()->apellido }}</h4>
                <p class="text-gray-400 text-sm">@ {{ auth()->user()->username }}</p>
            </div>
            <i class="fa-solid fa-chevron-down text-xs hidden xl:flex items-center xl:ml-4 text-gray-800 dark:text-white"></i>

        </a>
        <!-- Modal -->
        <div id="modal-container" class="modal">
            <div class="modal-content">
                <span id="closeModal" class="close">&times;</span>
                <form method="POST" action="{{ route('publicaciones.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="border pb-3 border-gray-200 dark:border-dim-200">
                        <div class="flex p-4">
                            @if(auth()->user()->avatar)
                                <img id="profile_pic" class="w-10 h-10 rounded-full" src="{{ auth()->user()->avatar }}" />
                            @else
                                <img id="profile_pic" class="w-10 h-10 rounded-full" src="{{ asset('img/default-avatar.jpg') }}" />
                            @endif
                            <textarea class="p-2 dark:text-white text-gray-900 w-full h-16 bg-transparent focus:outline-none resize-none"
                                      placeholder=" ¿Algo que decir, {{ auth()->user()->nombre }}?" name="contenido"></textarea>
                        </div>
                        <div class="flex p-4 w-full">
                            <a href="#" class="text-blue-400 rounded-full p-2">
                                <input type="file" name="media" accept="image/*,video/*" style="display: none;" id="input-media" onchange="previewMedia(event)">
                                <label for="input-media">
                                    <i class="fa-solid fa-image text-lg"></i>
                                </label>
                            </a>
                            <a href="#" class="text-blue-400 rounded-full p-2">
                                <i class="fa-solid fa-video text-lg"></i>
                            </a>
                            <button class="font-bold bg-blue-400 text-white rounded-full px-6 ml-auto mr-1 flex items-center" type="submit">
                                Postear
                            </button>
                        </div>
                    </div>
                </form>
              
            </div>
        </div>
    </div>
    <!-- End Left -->
    <!-- Middle -->
    <div class="w-full xl:w-1/2 h-screen overflow-y-auto">
        <!-- Sticky Header -->

        
        @yield('contenido')
        <!-- Spinner -->
    </div>
    <!-- Right -->
    <div class="hidden w-[30%] xl:block ">
        <!-- Search -->
        <div class="relative m-2">
            <i class="fa-solid fa-magnifying-glass text-gray-600 absolute left-4 top-1/2 -translate-y-1/2"></i>
            <input type="text" class="w-full bg-gray-200 dark:bg-dim-400 border-gray-200 dark:border-dim-400 text-gray-100 focus:outline-none font-normal h-9 pl-12 text-sm rounded-full" placeholder="Buscar en TecMunity"/>
        </div>
        <div class="bg-gray-50 dark:bg-dim-700 rounded-2xl m-2">
            <h3 class="text-gray-900 dark:text-white font-bold p-3 border-b border-gray-200 dark:border-dim-200">
                Noticias Tecsup
            </h3>
            <div class="p-3 border-b border-gray-200 dark:border-dim-200">
                <h4 class="font-bold text-gray-800 dark:text-white">
                    Titulo de la noticia
                </h4>
                <p class="text-xs text-gray-400">Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias a facilis sit voluptas odio magni accusamus assumenda consequatur at atque aspernatur quam obcaecati debitis quaerat cum quisquam similique, corporis qui.</p>
                <img class="w-30 h-40 rounded-media" src="https://pbs.twimg.com/profile_images/1444753598328496128/hCCopfyz_400x400.jpg" alt=""/>
            </div>
            <div class="p-3 border-b border-gray-200 dark:border-dim-200">
                <h4 class="font-bold text-gray-800 dark:text-white">
                    #Palestine
                </h4>
                <p class="text-xs text-gray-400">29.7K Tweets</p>
            </div>
            <div class="p-3 border-b border-gray-200 dark:border-dim-200">
                <h4 class="font-bold text-gray-800 dark:text-white">
                    #Palestine
                </h4>
                <p class="text-xs text-gray-400">29.7K Tweets</p>
            </div>
            <div class="text-blue-400 p-3 cursor-pointer">
                Mostrar mas
            </div>
        </div>
        <!-- Who to follow  -->
        <div class="bg-gray-50 dark:bg-dim-700 rounded-2xl m-2">
            <h3 class="text-gray-900 dark:text-white font-bold p-3 border-b border-gray-200 dark:border-dim-200">
                Solicitud de amistad
            </h3>
            <div class="p-5 border-b border-gray-200 dark:border-dim-200 flex justify-between items-center">
                <div class="flex ">
                    <img class="w-10 h-10 rounded-full" src="https://pbs.twimg.com/profile_images/1444753598328496128/hCCopfyz_400x400.jpg" alt=""/>
                    <div class="ml-2 text-sm">
                        <h5 class="text-gray-900 dark:text-white font-bold">
                            abdoelazizgamal
                        </h5>
                        <p class="text-gray-400">@abdoelazizgamal</p>
                    </div>
                </div>
                <a href="#" class="text-xs font-bold text-blue-400 px-4 py-1 rounded-full border-2 border-blue-400">Seguir</a>
            </div>
            <div class="p-5 border-b border-gray-200 dark:border-dim-200 flex justify-between items-center">
                <div class="flex ">
                    <img class="w-10 h-10 rounded-full" src="https://pbs.twimg.com/profile_images/1444753598328496128/hCCopfyz_400x400.jpg" alt=""/>
                    <div class="ml-2 text-sm">
                        <h5 class="text-gray-900 dark:text-white font-bold">
                            abdoelazizgamal
                        </h5>
                        <p class="text-gray-400">@abdoelazizgamal</p>
                    </div>
                </div>
                <a href="#" class="text-xs font-bold text-blue-400 px-4 py-1 rounded-full border-2 border-blue-400">Follow</a>
            </div>
            <div class="text-blue-400 p-3 cursor-pointer">
                Mostrar mas
            </div>
        </div>
    </div>
</div>



@stack('scripts')
</body>
<script>
    // Obtener el botón de abrir el modal y el modal en sí
var modalBtn = document.getElementById('openModal');
var modal = document.getElementById('modal-container');
var closeModalBtn = document.getElementById('closeModal');

// Función para abrir el modal
modalBtn.addEventListener('click', function() {
    modal.style.display = 'block';
});

// Función para cerrar el modal
closeModalBtn.addEventListener('click', function() {
    modal.style.display = 'none';
});

// Cerrar el modal si se hace clic fuera de él
window.addEventListener('click', function(event) {
    if (event.target == modal) {
        modal.style.display = 'none';
    }
});

</script>
</html>
