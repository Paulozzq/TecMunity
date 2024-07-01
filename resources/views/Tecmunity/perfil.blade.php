@extends('main')
@section('title')
    Perfil de {{ $perfil->nombre }}
    
@endsection
@section('contenido')

<div class="bg-black dark:bg-gray-800 shadow-lg rounded-lg mb-6">
    <!-- Portada del perfil -->
    @if($perfil->portada)
        <img id="portada" src="{{$perfil->portada }}" class="w-full h-full object-cover" />
    @else
        <img id="portada" src="{{ asset('img/bl.jpg') }}" class="w-full h-full object-cover" />
    @endif

    @if($perfil->avatar)
        <img class="w-16 h-16 rounded-full border-4 border-black dark:border-gray-800" style="height: 140px; width: 140px; position: relative; top: -80px; margin-bottom: -90px; border-radius: 100%; left: 10px;border: 4px solid grey;" src="{{ $perfil->avatar }}" alt="Avatar">
    @else
        <img class="w-16 h-16 rounded-full border-4 border-black dark:border-gray-800" style="height: 140px; width: 140px; position: relative; top: -80px; margin-bottom: -90px; border-radius: 100%; left: 10px;border: 4px solid grey;" src="{{ asset('img/default-avatar.jpg') }}" alt="Avatar">
    @endif

    <div class="p-6 pt-14">
        <div class="flex justify-between items-center mb-4">
            <div>
                <h2 class="text-2xl font-bold text-white dark:text-white">{{ $perfil->nombre }} {{ $perfil->apellido }}</h2>
                <p class="text-gray-400 dark:text-gray-400">@ {{ $perfil->username }}</p>
            </div>
            @if($perfil->id !== auth()->user()->id)
                        @if($noHayRelacionEntreEllos)
                            <form class="ajax-form" action="{{ route('perfil.seguir', ['id' => $perfil->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="follow-button bg-blue-500/20 border-2 border-blue-500 text-white hover:bg-blue-500 hover:text-white font-bold py-2 px-4 rounded-full shadow-lg transition duration-300 ease-in-out">Seguir</button>
                            </form>
                        @endif
                        @if($amigoUser)
                            @if($amistadPendiente)
                                <form class="ajax-form" action="{{ route('perfil.dejar-de-seguir', ['id' => $perfil->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="follow-button bg-blue-500/20 border-2 border-blue-500 text-white hover:bg-blue-500 hover:text-white font-bold py-2 px-4 rounded-full shadow-lg transition duration-300 ease-in-out">Dejar de seguir</button>
                                </form>
                            @endif
                        @endif
                        @if($amigo)
                            @if($amistadPendiente)
                                <form class="ajax-form" action="{{ route('perfil.seguirOtra', ['id' => $perfil->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="follow-button bg-blue-500/20 border-2 border-blue-500 text-white hover:bg-blue-500 hover:text-white font-bold py-2 px-4 rounded-full shadow-lg transition duration-300 ease-in-out">Seguir También</button>
                                </form>
                            @endif
                        @endif
                        @if($amistadExistente)
                            <form class="ajax-form" action="{{ route('perfil.dejar-de-seguir', ['id' => $perfil->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="follow-button bg-blue-500/20 border-2 border-blue-500 text-white hover:bg-blue-500 hover:text-white font-bold py-2 px-4 rounded-full shadow-lg transition duration-300 ease-in-out">Amigos</button>
                            </form>
                        @endif

                    @else
                    <form action="#" method="POST">
                        @csrf
                        <button type="button" onclick="openModal()" class="bg-blue-500/20 border-2 border-blue-500 text-white hover:bg-blue-500 hover:text-white font-bold py-2 px-4 rounded-full shadow-lg transition duration-300 ease-in-out">
                            Editar Perfil
                        </button>
                    </form>
                    @endif

                     
        </div>
        <p class="text-gray-400 dark:text-gray-200">{{ $perfil->biografia }}</p>
    </div>
</div>

<div id="modal" class="modal">
    <div class="modal-content">
    <div class="modal-header">
            <h2 style="color:aliceblue;font-size:26px">Editar Perfil</h2>
            <div class="border-gray-300 border-t"></div>
             <button onclick="closeModal()" class="modal-close" style="color:white"> X</button>
        </div>
        <div style="margin-top:-60px">
            <form action="{{ route('profile.update') }}" method="POST" class="modal-content">
                @csrf
                @method('POST') <!-- Método POST para enviar datos -->
            
                <!-- Contenido del formulario para editar perfil -->
                   <div class="mb-4">
                <label for="nombre" style="color: aliceblue;" class="block text-sm font-medium">Nombre:</label>
                <input type="text" id="nombre" name="nombre" placeholder="Nombre" style="background-color: transparent; margin: 0; padding: 0.5rem; color: aliceblue;" class="form-input mt-1 block w-full rounded-lg border-gray-300" value="{{ $perfil->nombre }}" required>
                <span id="nombreError" class="error-message hidden text-red-500">El nombre no debe contener números ni signos especiales.</span>
                <div class="border-gray-300 border-t"></div>
            </div>

            <div class="mb-4">
                <label for="apellido" style="color: aliceblue;" class="block text-sm font-medium">Apellido:</label>
                <input type="text" id="apellido" name="apellido" placeholder="Apellido" style="background-color: transparent; margin: 0; padding: 0.5rem; color: aliceblue;" class="form-input mt-1 block w-full rounded-lg border-gray-300" value="{{ $perfil->apellido }}" required>
                <span id="apellidoError" class="error-message hidden text-red-500">El apellido no debe contener números ni signos especiales.</span>
                <div class="border-gray-300 border-t"></div>
            </div><br>
                <label for="fecha_nacimiento" style="color: aliceblue;">Fecha de Nacimiento:</label>
                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" style="background-color: transparent; margin: 0 !important; padding: 0.5rem;color:aliceblue" class=" mb-2 w-full" value="{{ $perfil->fecha_nacimiento }}">
                <div class="border-gray-300 border-t"></div> <br>
                <label for="sexo" style="color: aliceblue;">Sexo:</label>
                <select id="sexo" name="sexo" style="background-color: transparent; margin: 0 !important; padding: 0.5rem;color:aliceblue" class=" mb-2 w-full">
                    <option value="masculino" style="color:black" @if($perfil->sexo == 'masculino') selected @endif>Masculino</option>
                    <option value="femenino" style="color:black" @if($perfil->sexo == 'femenino') selected @endif>Femenino</option>
                </select>
                <div class="border-gray-300 border-t"></div><br>
                <div class="flex items-center mb-2">
                    <input type="checkbox" id="privado" name="privado" class="form-checkbox h-5 w-5 text-blue-500 rounded mr-2" @if($perfil->privado) checked @endif>
                    <label for="privado" class="text-gray-300" style="color:white">Perfil privado</label>
                </div><div class="border-gray-300 border-t"></div><br>

                <div class="flex items-center mb-2"><br>
                      <label for="privado" class="text-gray-300" style="color:white">Correo electronico
                    <input type="email" id="email" name="email" placeholder="Email" style="background-color: transparent; margin: 0; padding: 0.5rem; color: aliceblue;" class="form-input mt-1 block w-full rounded-lg border-gray-300"    value="{{ auth()->user()->email }}" readonly>
                </div>
               
                <div class="border-gray-300 border-t"></div> <br>
                <label for="biografia" style="color: aliceblue;">Biografía:</label>
                <textarea id="biografia" name="biografia" placeholder="Biografía" style="background-color: transparent; margin: 0 !important; padding: 0.5rem;color:aliceblue" class=" mb-2 w-full">{{ $perfil->biografia }}</textarea>
                <div class="border-gray-300 border-t"></div> <br>
                
                
            
                <label for="ID_carrera" style="color: aliceblue;">Carrera:</label>
                <select id="ID_carrera" name="ID_carrera" class="mb-2 w-full" style="background-color: transparent; margin: 0 !important; padding: 0.5rem; color: aliceblue;" {{ $perfil->ID_carrera ? 'disabled' : '' }}>
                    @foreach($carreras as $carrera)
                        <option style="color:black" value="{{ $carrera->ID_carrera }}" {{ $perfil->ID_carrera == $carrera->ID_carrera ? 'selected' : '' }}>
                            {{ $carrera->nombre }}
                        </option>
                    @endforeach
                </select>
                
                
                <div class="border-gray-300 border-t"></div><br>
                <label for="username" style="color: aliceblue;">Nombre de Usuario:</label>
                <input type="text" id="username" name="username" placeholder="Nombre de Usuario" style="background-color: transparent; margin: 0 !important; padding: 0.5rem;color:aliceblue" class=" mb-2 w-full"value="{{ $perfil->username }}" required>
                <div class="border-gray-300 border-t"></div> <br><br>
                <div class="modal-footer flex justify-end mt-4">
                    <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-full shadow-lg hover:bg-blue-600 transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Guardar Cambios
                    </button>
                </div>
                
                
            </form>

            <button onclick="closeModal()" class="modal-close" style="color:white"> Salir</button>
        
        
        </div>
        
    </div>
</div>
<script>
  
    // Validación de caracteres permitidos en nombre y apellido
    document.getElementById('profileForm').addEventListener('submit', function(event) {
        const nombre = document.getElementById('nombre');
        const apellido = document.getElementById('apellido');
        const nombreError = document.getElementById('nombreError');
        const apellidoError = document.getElementById('apellidoError');
        const nombreRegex = /^[A-Za-z\s]+$/; // Expresión regular para solo letras y espacios
        const apellidoRegex = /^[A-Za-z\s]+$/; // Expresión regular para solo letras y espacios

        if (!nombreRegex.test(nombre.value)) {
            nombre.classList.add('border-red-500');
            nombreError.classList.remove('hidden');
            event.preventDefault(); // Evita el envío del formulario si hay error
        } else {
            nombre.classList.remove('border-red-500');
            nombreError.classList.add('hidden');
        }

        if (!apellidoRegex.test(apellido.value)) {
            apellido.classList.add('border-red-500');
            apellidoError.classList.remove('hidden');
            event.preventDefault(); // Evita el envío del formulario si hay error
        } else {
            apellido.classList.remove('border-red-500');
            apellidoError.classList.add('hidden');
        }
    });
</script>
<script>
    // Función para abrir el modal
    function openModal() {
        document.getElementById('modal').style.display = 'block';
    }

    // Función para cerrar el modal
    function closeModal() {
        document.getElementById('modal').style.display = 'none';
    }
</script>

@if($perfil->privado == 1 && $perfil->id !== auth()->user()->id)
<div class="right_row">
    <div class="bg-gray-900 dark:bg-gray-900 p-4">
        <div class="text-gray-100 dark:text-gray-100">Este perfil es privado.</div>
    </div>
</div>
@else

<div class="relative mb-10">
    <div class="absolute inset-0 flex items-center">
        <div class="w-full border-t border-gray-300"></div>
    </div>
    <div class="relative flex justify-center">
    @if($sinnada == 0) 
     @if(auth()->user()->id ==$perfil->id)
        <div class="text-gray-100 dark:text-gray-100">No tienes publicaciones {{$perfil->nombre}}</div>

          
      @else
        <div class="text-gray-100 dark:text-gray-100"> {{$perfil->nombre}}, no tiene publicaciones</div>
      @endif
    @else
        <div class="text-gray-100 dark:text-gray-100">Publicaciones de {{$perfil->nombre}}</div>
   
    @endif
   
    </div>
</div>

<!-- Sección de publicaciones -->
@foreach($publicaciones as $publicacion)
<div class="border border-gray-200 dark:border-dim-200 cursor-pointer pb-4 mb-6">
    <a href="{{ route('perfil.show', ['id' => $publicacion->usuario->id]) }}">
        <div class="flex p-4 pb-0">
            @if($publicacion->usuario->avatar)
            <img id="profile_pic" class="w-10 h-10 rounded-full" src="{{ $publicacion->usuario->avatar }}" />
            @else
            <img id="profile_pic" class="w-10 h-10 rounded-full" src="{{ asset('img/default-avatar.jpg') }}" />
            @endif
            <p class="ml-2 flex flex-shrink-0 items-center font-medium text-gray-800 dark:text-white">
                <span>{{ $publicacion->usuario->nombre }} {{ $publicacion->usuario->apellido }}
                    <span class="ml-1 text-sm leading-5 text-gray-400">
                        @ {{ $publicacion->usuario->username }} .{{ $publicacion->created_at->format('d F') }}
                    </span>
                </span> </a>
               @if(auth()->user()->id == $publicacion->usuario->id)
    <div class="ml-auto flex items-center dark:text-white text-xs text-gray-400 hover:text-blue-400 dark:hover:text-blue-400">
        <form id="delete-form-{{ $publicacion->ID_publicacion }}" action="{{ route('publicaciones.destroy', ['publicacion' => $publicacion->ID_publicacion]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="button" onclick="confirmDelete({{ $publicacion->ID_publicacion }})">
                <i class="fa-solid fa-trash mr-2 text-lg"></i>
            </button>
        </form>
    </div>
@endif

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(publicacionId) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta acción no se puede deshacer.",
            icon: 'warning',
            background: '#15202b',
            color: '#fff',
            showCancelButton: true,
            confirmButtonColor: '#1DA1F2', // Azul claro
            cancelButtonColor: '#FF4757', // Rojo claro
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + publicacionId).submit();
            }
        });
    }
</script>

            </p>
        </div>
        <br>
        <div class="border-b border-gray-200 dark:border-dim-200"></div>
        <br>
        <div class="pl-8 xl:pl-16 pr-4">
            <p class="font-medium text-gray-800 dark:text-white whitespace-pre-wrap" style="word-wrap: break-word; word-break: break-word;">
                {{ $publicacion->contenido }}
            </p>
            @if($publicacion->video_url)
            <div class="feed_content_video">
                <a href="{{ $publicacion->video_url }}" target="_blank">{{ $publicacion->video_url }}</a>
            </div>
            @endif
            @if($publicacion->isVideo())
            <video controls>
                <source src="{{ $publicacion->url_media }}" type="video/mp4">
                Tu navegador no soporta la etiqueta de video.
            </video>
            @else
            <a href="{{ $publicacion->url_media }}" target="_blank">
                <img src="{{ $publicacion->url_media }}" alt="" />
            </a>
            @endif
            <br>
            <div class="border-b border-gray-200 dark:border-dim-200"></div>
            <br>
            <div class="flex items-center w-full justify-between">
                <div class="flex items-center dark:text-white text-xs text-gray-400 hover:text-blue-400 dark:hover:text-blue-400">
                    <i class="fa-solid fa-comment mr-2 text-lg"></i>
                    <a href="{{ route('comentario.show', ['id' => $publicacion->ID_publicacion]) }}"> {{ $publicacion->comentarios->count() }} comentarios </a>
                </div>
                <div class="flex items-center dark:text-white text-xs text-gray-400 hover:text-green-400 dark:hover:text-green-400">
                    @if ($publicacion->likes->where('ID_usuario', Auth::id())->isEmpty())
                    <form id="likeForm_{{ $publicacion->ID_publicacion }}" action="{{ route('like.publicacion', $publicacion->ID_publicacion) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-like"><i class="fa-solid fa-heart mr-2 text-lg"></i>
                            {{ $publicacion->likes->count() }}
                        </button>
                    </form>
                    @else
                    <form id="unlikeForm_{{ $publicacion->ID_publicacion }}" action="{{ route('unlike.publicacion', $publicacion->ID_publicacion) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-unlike"><i class="fa-solid fa-heart mr-2 text-lg"></i>
                            {{ $publicacion->likes->count() }}
                        </button>
                    </form>
                    @endif
                </div>
                @if($publicacion->usuario->id !== auth()->id())
                     <div class="flex items-center dark:text-white text-xs text-gray-400 hover:text-blue-400 dark:hover:text-blue-400">
                         <i class="fa-solid fa-flag mr-2 text-lg"></i>
                     </div>
                @endif

            </div>
        </div>
   
</div>
@endforeach
@endif

<script type="text/javascript">
    $(document).ready(function() {
        function handleAjaxFormSubmission(form, actionUrl, button) {
            $.ajax({
                url: actionUrl,
                type: 'POST',
                data: form.serialize(),
                success: function(response) {
                    $('#status-message').text(response.success).show().delay(3000).fadeOut();
                    updateFollowButton(response.success, button, form);
                },
                error: function(xhr) {
                    $('#status-message').text(xhr.responseJSON.error).show().delay(3000).fadeOut();
                }
            });
        }

        function updateFollowButton(successMessage, button, form) {
            if (successMessage.includes("sigues") || successMessage.includes("Amigos")) {
                button.text('Dejar de seguir');
                form.attr('action', '{{ route("perfil.dejar-de-seguir", ["id" => $perfil->id]) }}');
            } else if (successMessage.includes("Has dejado")) {
                button.text('Seguir');
                form.attr('action', '{{ route("perfil.seguir", ["id" => $perfil->id]) }}');
            } else if (successMessage.includes("también")) {
                button.text('Amigos');
                form.attr('action', '{{ route("perfil.dejar-de-seguir", ["id" => $perfil->id]) }}');
            }
        }

        $('.ajax-form').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var actionUrl = form.attr('action');
            var button = form.find('.follow-button');
            handleAjaxFormSubmission(form, actionUrl, button);
        });

        function checkFriendshipStatus() {
            $.ajax({
                url: '{{ route("perfil.checkFriendshipStatus", ["id" => $perfil->id]) }}',
                type: 'GET',
                success: function(response) {
                    var button = $('.follow-button');
                    var form = button.closest('form');

                    if (response.amistadExistente) {
                        button.text('Amigos');
                        form.attr('action', '{{ route("perfil.dejar-de-seguir", ["id" => $perfil->id]) }}');
                    } else if (response.amistadPendiente) {
                        button.text('Dejar de seguir');
                        form.attr('action', '{{ route("perfil.dejar-de-seguir", ["id" => $perfil->id]) }}');
                    } else if (response.amistadPendienteParaAmigo) {
                        button.text('Seguir También');
                        form.attr('action', '{{ route("perfil.seguirOtra", ["id" => $perfil->id]) }}');
                    } else {
                        button.text('Seguir');
                        form.attr('action', '{{ route("perfil.seguir", ["id" => $perfil->id]) }}');
                    }
                },
                error: function(xhr) {
                    console.log('Error checking friendship status:', xhr.responseJSON.error);
                }
            });
        }

        setInterval(checkFriendshipStatus, 5000);
    });
</script>


@endsection
