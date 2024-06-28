@extends('main')

@section('title', 'Publicaciones')

@section('contenido')
    <div class="flex justify-between items-center border px-4 py-3 sticky top-0 bg-white dark:bg-dim-900 border-gray-200 dark:border-gray-700">
        <h4 class="text-gray-800 dark:text-gray-100 font-bold">
            Inicio
        </h4>
        <i class="fa-brands fa-twitter text-lg text-blue-400"></i>
    </div>
    <!-- Tweet Box -->
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
    <!-- Show tweets -->
    <div class="text-center py-4 bg-white dark:bg-dim-900 border border-gray-200 dark:border-dim-200 cursor-pointer text-blue-400 text-sm">
        Posts de los admins
    </div>
    <!-- Tweet -->
    @foreach($publicaciones as $publicacion)
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
                <br><br><br> <div class="border-b border-gray-200 dark:border-dim-200"></div><br>
                    <div class="flex items-center w-full justify-between">
                        <div class="flex items-center dark:text-white text-xs text-gray-400 hover:text-blue-400 dark:hover:text-blue-400">
                            <i class="fa-solid fa-comment mr-2 text-lg"></i>
                            <a href="{{ route('comentario.show', ['id' => $publicacion->ID_publicacion]) }}"> {{ $publicacion->comentarios->count() }} comentarios  </a>
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
                        <div class="flex items-center dark:text-white text-xs text-gray-400 hover:text-blue-400 dark:hover:text-blue-400">
                            <i class="fa-solid fa-flag mr-2 text-lg"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
@endsection
