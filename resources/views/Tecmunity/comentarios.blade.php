@extends('main')

@section('title', 'Comentarios')

@section('contenido')
    <div class="flex justify-between items-center border px-4 py-3 sticky top-0 bg-white dark:bg-dim-900 border-gray-200 dark:border-gray-700">
        <h4 class="text-gray-800 dark:text-gray-100 font-bold">
           Publicacion
        </h4>
        <i class="fa-brands fa-twitter text-lg text-blue-400"></i>
    </div>
    <!-- Tweet Box -->

    <div class="border border-gray-200 dark:border-dim-200 cursor-pointer pb-4">
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
                    </span>
                </p>
            </div>
            <br><div class="border-b border-gray-200 dark:border-dim-200"></div><br>
            
            <div class="pl-8 xl:pl-16 pr-4">
                <p class="font-medium text-gray-800 dark:text-white" style="word-wrap: break-word; word-break: break-word;">
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
            <br><br><br> 
            </div>
           
        </a>
    </div> <br>
    <h2 class="my-4" style="text-align: center;color:white;font-size:20px"> <strong> Seccion de Comentarios</strong></h2> <br>
    <form method="POST" action="{{ route('comentarios.store') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="publicacion_id" value="{{ $publicacion->ID_publicacion }}">
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
                    Comentar
                </button>
            </div>
        </div>
    </form>
    <!-- Show tweets -->
    <div class="text-center py-4 bg-white dark:bg-dim-900 border border-gray-200 dark:border-dim-200 cursor-pointer text-blue-400 text-sm">
        Comentarios de los admins
    </div>
    <!-- Tweet -->
    @foreach($comentarios as $publicacion)
        <div class="border border-gray-200 dark:border-dim-200 cursor-pointer pb-4">
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
                        </span>
                    </p>
                </div>
                <br><div class="border-b border-gray-200 dark:border-dim-200"></div><br>
                
                <div class="pl-8 xl:pl-16 pr-4">
                    <p class="font-medium text-gray-800 dark:text-white" style="word-wrap: break-word; word-break: break-word">
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
                <br><br><br> <div class="border-b border-gray-200 dark:border-dim-200"></div><br>
                    <div class="flex items-center w-full justify-between">
                        <div class="flex items-center dark:text-white text-xs text-gray-400 hover:text-blue-400 dark:hover:text-blue-400">
                            <i class="fa-solid fa-comment mr-2 text-lg"></i>
                            <a href="{{ route('comentario.showReply', ['id' => $publicacion->ID_comentario]) }}">
                                {{ optional($publicacion->comentarios)->count() ?? 0 }} respuestas
                            </a>
                        </div>
                        
                        
                        <div class="flex items-center dark:text-white text-xs text-gray-400 hover:text-green-400 dark:hover:text-green-400">
                            @if ($publicacion->likes->where('ID_usuario', Auth::id())->isEmpty())
                                <form action="{{ route('like.publicacion', $publicacion->ID_publicacion) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-like"><i class="fa-solid fa-heart mr-2 text-lg"></i>
                                        {{ $publicacion->likes->count() }}
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('unlike.publicacion', $publicacion->ID_publicacion) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-unlike"><i class="fa-solid fa-heart mr-2 text-lg"></i>
                                        {{ $publicacion->likes->count() }}
                                    </button>
                                </form>
                            @endif
                        </div>
                        <div class="flex items-center dark:text-white text-xs text-gray-400 hover:text-blue-400 dark:hover:text-blue-400 cursor-pointer" onclick="openReportModal()">
                            <i class="fa-solid fa-flag mr-2 text-lg"></i> Reportar 
                        </div>
                    </div>
                </div>
                
            </a>
        </div>

        <div id="reportModal" class="modal">
            <div class="modal-content">
                <div class="modal-header flex items-center justify-between">
                    <span class="modal-close cursor-pointer text-white text-2xl" onclick="closeReportModal()">X</span>
                    <h2 class="text-xl font-bold text-white">Reportar Comentarios</h2>

                </div> <br>
                <hr class="border-2 border-white"><br>
                <div class="modal-body">
                    
                    <!-- Contenido del formulario de denuncia -->
                    <form action="{{ route('denuncias.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="denunciado" class="block text-lg font-medium text-white">Usuario a denunciar:</label>
                           
                            <select id="denunciado"  name="denunciado" class="form-select w-full mt-1 border-gray-300 rounded-lg bg-transparent text-white" required>
                                <option value="">Selecciona a quién deseas denunciar</option>
                                @foreach($usuarios as $usuario)
                                    <option style="background-color: transparent;color:black" value="{{ $usuario->id }}">{{ $usuario->nombre }} {{$usuario->apellido}}  </option>
                                    <!-- Ajusta 'id' y 'nombre' según la estructura de tu modelo Usuario -->
                                @endforeach
                            </select>
                            @error('denunciado')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div> <hr class="border-gray-400 my-2"> 
                        
                        <div class="mb-4">
                            <label for="denunciado" class="block text-lg font-medium text-white">Publicacion que deseas denunciar :</label>
                            
                            <select id="publicacion"    name="publicacion" class="form-select w-full mt-1 border-gray-300 rounded-lg bg-transparent text-white" required>
                                <option value="">Seleccion el comentario que desea denunciar</option>
                                @foreach($comentarios as $comentario)
                                    <option  style="color:black" value="{{ $comentario->id }}">{{ $comentario->contenido }}</option>
                                    <!-- Aquí asumo que tienes un atributo 'titulo' en tu modelo de publicaciones -->
                                @endforeach
                            </select>
                            @error('publicacion')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>  <hr class="border-gray-400 my-2">
                        <div class="mb-4">
                            <label for="denunciado" class="block text-lg font-medium text-white">Tipos de denuncias:</label>
                            <select id="ID_tipodenuncia" name="ID_tipodenuncia" class="form-select w-full mt-1 border-gray-300 rounded-lg bg-transparent text-white" required>
                                <option value="">Selecciona el tipo de denuncia</option>
                                @foreach($tiposDenuncias as $tipoDenuncia)
                                    <option style="color:black" value="{{ $tipoDenuncia->ID_tipodenuncia }}">{{ $tipoDenuncia->nombre_tipo }}</option>
                                @endforeach
                            </select>
                            @error('ID_tipodenuncia')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>  <hr class="border-gray-400 my-2">
                        <div class="mb-4">
                            <label for="denunciado" class="block text-lg font-medium text-white">Motivo de la denuncia:</label>
                            <textarea id="contenido" name="contenido" rows="4" class="form-textarea w-full mt-1 border-gray-300 rounded-lg bg-transparent text-white" placeholder="Describe brevemente el motivo de tu denuncia..." required></textarea>
                            @error('contenido')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>  <hr class="border-gray-400 my-2">
                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-full shadow-lg hover:bg-blue-600 transition duration-300 ease-in-out">
                                Enviar Denuncia
                            </button>
                        </div>
                    </form>
                    
                    
                </div>
            </div>
        </div>
        <script>
            // Función para abrir el modal de denuncia
            function openReportModal() {
                document.getElementById('reportModal').style.display = 'block';
            }
        
            // Función para cerrar el modal de denuncia
            function closeReportModal() {
                document.getElementById('reportModal').style.display = 'none';
            }
        
            // Cerrar el modal si se hace clic fuera de él (opcional)
            window.onclick = function(event) {
                const reportModal = document.getElementById('reportModal');
                if (event.target === reportModal) {
                    reportModal.style.display = 'none';
                }
            }
        </script>
    @endforeach
@endsection
