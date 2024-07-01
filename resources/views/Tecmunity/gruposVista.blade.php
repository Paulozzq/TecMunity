@extends('main')
@section('title')
    Grupo de {{$grupo->nombre}}
    
@endsection
@section('contenido')



<div class="bg-black dark:bg-gray-800 shadow-lg rounded-lg mb-6">
    <!-- Mostrar la información del grupo -->
    <div class="bg-black dark:bg-gray-800 shadow-lg rounded-lg mb-6">
        <!-- Mostrar la portada del grupo si está definida -->
        @if($infoGrupo && $infoGrupo->portada)
            <img id="portada" src="{{ $infoGrupo->portada }}" class="w-full h-full object-cover" />
        @else
            <!-- Mostrar una imagen predeterminada o un mensaje si no hay portada -->
            <img id="portada" src="{{ asset('img/bl.jpg') }}" class="w-full h-full object-cover" />
        @endif
    
        <!-- Mostrar el avatar del grupo si está definido -->
        @if($infoGrupo && $infoGrupo->avatar)
            <img class="w-16 h-16 rounded-full border-4 border-black dark:border-gray-800" style="height: 140px; width: 140px; position: relative; top: -80px; margin-bottom: -90px; border-radius: 100%; left: 10px;border: 4px solid grey;" src="{{ $infoGrupo->avatar }}" alt="Avatar">
        @else
            <!-- Mostrar un avatar predeterminado si no hay avatar definido -->
            <img class="w-24 h-24 md:w-32 md:h-32 rounded-full border-4 border-gray-400 dark:border-gray-800 mx-auto md:mx-0" style="position: relative; top: -80px; margin-bottom: -90px; border-color: black; box-shadow: 0px 0px 0px 7px black;" src="{{ asset('img/default-avatar.jpg') }}" alt="Avatar">


        @endif
    
        <div class="p-6 pt-14">
            <!-- Mostrar el nombre del grupo -->
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h2 class="text-2xl font-bold text-white dark:text-white">{{ $grupo->nombre }}</h2>
                </div>
            </div> <br>
            <div class="border-b border-gray-300"></div> <br>

            <!-- Mostrar la descripción del grupo si está definida -->
            @if($infoGrupo && $infoGrupo->descripcion)
            <label for="" class="text-white text-l">Descripción del grupo</label>

                <p class="text-gray-400 dark:text-gray-400">{{ $infoGrupo->descripcion }}</p>
            @else
                <!-- Mostrar un mensaje alternativo si no hay descripción -->
                <p class="text-gray-400 dark:text-gray-400">Descripción no disponible</p>
            @endif
        </div>
    </div>
    

    <!-- Botón o enlace para editar -->
    @if(Auth::id() === $grupo->ID_creador)
    <div class="flex justify-end -mt-8" >
        <button id="editGroupInfoBtn" class="bg-blue-500/20 border-0 border-blue-500 text-white hover:bg-blue-500 hover:text-white font-bold py-2 px-4 rounded-full shadow-lg transition duration-300 ease-in-out focus:outline-none ml-auto -mt-8" style="margin-top:-40px">
            <i class="fas fa-pencil-alt"></i>
        </button>
    </div>
@endif





    <!-- Formulario para editar (inicialmente oculto) -->
    <div id="editGroupInfoForm" class="hidden">
        <form action="{{ route('grupos.guardarInfoGrupo', ['id' => $grupo->ID_grupos]) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="descripcion" class="text-white text-lg">Descripción del grupo</label>
                <textarea name="descripcion" id="descripcion" required   rows="1" class="form-textarea mt-1 block w-full border-gray-300 dark:border-dim-500 focus:border-blue-400 focus:outline-none focus:ring dark:text-gray-300 rounded-md bg-transparent text-white">{{ old('descripcion', $infoGrupo ? $infoGrupo->descripcion : '') }}</textarea>
               
            </div>
            <div class="border-b border-gray-300"></div> <br>
            <div class="mb-4">
                <label for="avatar" class="text-white text-lg">Avatar del grupo</label>
                <input type="file" name="avatar" id="avatar" class="form-input mt-1 block w-full border-gray-300 dark:border-dim-500 focus:border-blue-400 focus:outline-none focus:ring dark:text-gray-300 rounded-md bg-transparent text-white">
                @error('avatar')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div> <div class="border-b border-gray-300"></div> <br>
            <div class="mb-4">
                <label for="descripcion" class="text-white text-lg">Portada del grupo</label>
                <input type="file" name="portada" id="portada" value="{{ old('portada', $infoGrupo ? $infoGrupo->portada : '') }}" class="form-input mt-1 block w-full border-gray-300 dark:border-dim-500 focus:border-blue-400 focus:outline-none focus:ring dark:text-gray-300 rounded-md bg-transparent text-white">
                @error('portada')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div> <div class="border-b border-gray-300"></div><br>
            <div class="mb-4">
                <label for="descripcion" class="text-white text-lg">Tema del grupo</label>
                <input type="text" name="tema" id="tema"  required value="{{ old('tema', $infoGrupo ? $infoGrupo->tema : '') }}" class="form-input mt-1 block w-full border-gray-300 dark:border-dim-500 focus:border-blue-400 focus:outline-none focus:ring dark:text-gray-300 rounded-md bg-transparent text-white">
               
            </div>  <div class="border-b border-gray-300"></div><br>
            <div class="mb-4">
                <label for="descripcion" class="text-white text-lg">Privado</label>
                <select name="privado" id="privado" required  class="form-select mt-1 block w-full border-gray-300 dark:border-dim-500 focus:border-blue-400 focus:outline-none focus:ring dark:text-gray-300 rounded-md bg-transparent text-white">
                    <option style="color:black" value="1" {{ old('privado', $infoGrupo && $infoGrupo->privado ?  'selected' : '') }}    >Sí</option>
                    <option style="color:black" value="0" {{ old('privado', $infoGrupo && !$infoGrupo->privado ? 'selected' : '') }}>No</option>
                </select>
              
            </div> <div class="border-b border-gray-300"></div> <br>
            <div class="flex justify-end mt-4">
                <button type="submit" class="bg-blue-500 text-white hover:bg-blue-600 font-bold py-2 px-4 rounded-lg shadow-lg transition duration-300 ease-in-out">
                    Guardar
                </button>
                
            </div>
        </form>
        
    </div> <br>
</div>

<script>
    // JavaScript para mostrar/ocultar el formulario de edición
    document.getElementById('editGroupInfoBtn').addEventListener('click', function() {
        document.getElementById('editGroupInfoForm').classList.toggle('hidden');
    });
</script>


    <!-- Group Info Section -->
    <form method="POST" action="{{ route('grupos.publicaciones.store', ['grupo' => $grupo->ID_grupos]) }}" enctype="multipart/form-data">
        @csrf
        <div class="border pb-3 border-gray-200 dark:border-dim-200">
            <div class="flex p-4">
                @if(auth()->user()->avatar)
                    <img id="profile_pic" class="w-10 h-10 rounded-full" src="{{ auth()->user()->avatar }}" />
                @else
                    <img id="profile_pic" class="w-10 h-10 rounded-full" src="{{ asset('img/default-avatar.jpg') }}" />
                @endif
                <textarea class="p-2 dark:text-white text-gray-900 w-full h-16 bg-transparent focus:outline-none resize-none"
                          placeholder="¿Algo que decir en {{$grupo->nombre}}, {{ auth()->user()->nombre }}?" name="contenido"></textarea>
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


    <!-- Usuarios Section -->
    

    <div class="border-b border-gray-200 dark:border-dim-200"></div> <br>
    <h4 class="text-gray-800 dark:text-gray-100 font-bold">
        Publicaciones del grupo de  {{ $grupo->nombre }}
    </h4> <br>
    
    
    

    <!-- Group Posts Section -->
    @if ($publicaciones->isEmpty())
        <div class="flex justify-center items-center h-64">
            <p class="text-white text-center text-lg px-8">No hay publicaciones en este grupo.</p>
        </div>
    @else
    @foreach($publicaciones as $publicacion)
    <div class="border border-gray-200 dark:border-dim-200 cursor-pointer pb-4 mb-6">
        <div class="flex p-4 pb-0">
            @if($publicacion->usuario && $publicacion->usuario->avatar)
                <img id="profile_pic" class="w-10 h-10 rounded-full" src="{{ $publicacion->usuario->avatar }}" />
            @else
                <img id="profile_pic" class="w-10 h-10 rounded-full" src="{{ asset('img/default-avatar.jpg') }}" />
            @endif
            <p class="ml-2 flex flex-shrink-0 items-center font-medium text-gray-800 dark:text-white">
                <span>
                    @if($publicacion->usuario)
                        <span class="ml-1 text-sm leading-5 text-gray-400">
                            {{ $publicacion->usuario->nombre ?? 'Usuario Anónimo' }} {{ $publicacion->usuario->apellido ?? '' }}
                            ({{ $publicacion->usuario->username ?? '' }})
                        </span>
                    @else
                        <span class="ml-1 text-sm leading-5 text-gray-400">Usuario Anónimo</span>
                    @endif
                </span>
            </p>
            @if($publicacion->usuario && auth()->user()->id == $publicacion->usuario->id)
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
            @elseif($publicacion->url_media)
                <a href="{{ $publicacion->url_media }}" target="_blank">
                    <img src="{{ $publicacion->url_media }}" alt="" />
                </a>
            @endif
            <br><br><br>
            <div class="border-b border-gray-200 dark:border-dim-200"></div>
            <br>
            <div class="flex items-center w-full justify-between">
                <div class="flex items-center dark:text-white text-xs text-gray-400 hover:text-blue-400 dark:hover:text-blue-400">
                    <i class="fa-solid fa-comment mr-2 text-lg"></i>
                    <a href="{{ route('comentarios.grupo.show', ['id' => $publicacion->ID_publicacion]) }}">
                        {{ $publicacion->comentarios->count() }} comentarios
                    </a>
                </div>
                
                <div class="flex items-center dark:text-white text-xs text-gray-400 hover:text-green-400">
                    @if ($publicacion->likes->where('ID_usuario', Auth::id())->isEmpty())
                        <form id="likeForm_{{ $publicacion->ID_publicacion }}" action="{{ route('grupo.publicaciones.like', $publicacion->ID_publicacion) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-like">
                                <i class="fa-solid fa-heart mr-2 text-lg"></i>
                                {{ $publicacion->likes->count() }}
                            </button>
                        </form>
                    @else
                        <form id="unlikeForm_{{ $publicacion->ID_publicacion }}" action="{{ route('grupo.publicaciones.unlike', $publicacion->ID_publicacion) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-unlike">
                                <i class="fa-solid fa-heart mr-2 text-lg"></i>
                                {{ $publicacion->likes->count() }}
                            </button>
                        </form>
                    @endif
                </div>
                
                @if($publicacion->usuario && $publicacion->usuario->id !== auth()->id())
                    <div class="flex items-center dark:text-white text-xs text-gray-400 hover:text-blue-400 dark:hover:text-blue-400">
                        <i class="fa-solid fa-flag mr-2 text-lg"></i>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endforeach

    @endif

@endsection
