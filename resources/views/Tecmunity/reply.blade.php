@extends('main')

@section('title', 'Reply')

@section('contenido')
    <div class="flex justify-between items-center border px-4 py-3 sticky top-0 bg-white dark:bg-dim-900 border-gray-200 dark:border-gray-700">
        <h4 class="text-gray-800 dark:text-gray-100 font-bold">
            Comentario de {{$user->username}}
        </h4>
        <i class="fa-brands fa-twitter text-lg text-blue-400"></i>
    </div>
    <!-- Tweet Box -->

    <div class="border border-gray-200 dark:border-dim-200 cursor-pointer pb-4">
        <a href="{{ route('perfil.show', ['id' => $user->id]) }}">
            <div class="flex p-4 pb-0">
                @if($user->avatar)
                    <img id="profile_pic" class="w-10 h-10 rounded-full" src="{{ $user->avatar }}" />
                @else
                    <img id="profile_pic" class="w-10 h-10 rounded-full" src="{{ asset('img/default-avatar.jpg') }}" />
                @endif
                <p class="ml-2 flex flex-shrink-0 items-center font-medium text-gray-800 dark:text-white">
                    <span>{{ $user->nombre }} {{ $user->apellido }}
                        <span class="ml-1 text-sm leading-5 text-gray-400">
                            @ {{ $user->username }} .{{ $publicacion->created_at->format('d F') }}
                        </span>
                    </span>
                </p>
            </div>
            <br><div class="border-b border-gray-200 dark:border-dim-200"></div><br>
            
            
            <div class="pl-8 xl:pl-16 pr-4">
                <p class="font-medium text-gray-800 dark:text-white" style="word-wrap: break-word; word-break: break-word;">
                    {{ $comentarios->contenido }}
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
    <h2 class="my-4" style="text-align: center;color:white;font-size:20px"> <strong> Seccion de Respuestas</strong></h2> <br>
    <form method="POST" action="{{ route('comentarios.reply') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="reply" value="{{ $comentarios->ID_comentario  }}">
        <input type="hidden" name="publicacion_id" value="{{ $comentarios->ID_publicacion }}">
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
                   Responder
                </button>
            </div>
        </div>
    </form>

    <!-- Mostrar publicaciones -->
    <div class="text-center py-4 bg-white dark:bg-dim-900 border border-gray-200 dark:border-dim-200 cursor-pointer text-blue-400 text-sm">
        Respuestas de los admins
    </div>

   
    

    <!-- Mostrar respuestas -->
    @if(!empty($reply))
    @foreach($reply as $replys)
    <div class="border border-gray-200 dark:border-dim-200 cursor-pointer pb-4">
        <a href="{{ route('perfil.show', ['id' => $replys->usuario->id]) }}">
            <div class="flex p-4 pb-0">
                @if($replys->usuario->avatar)
                    <img id="profile_pic" class="w-10 h-10 rounded-full" src="{{ $replys->usuario->avatar }}" />
                @else
                    <img id="profile_pic" class="w-10 h-10 rounded-full" src="{{ asset('img/default-avatar.jpg') }}" />
                @endif
                <p class="ml-2 flex flex-shrink-0 items-center font-medium text-gray-800 dark:text-white">
                    <span>{{ $replys->usuario->nombre }} {{$replys->usuario->apellido }}
                        <span class="ml-1 text-sm leading-5 text-gray-400">
                            @ {{$replys->usuario->username }} .{{ $replys->created_at->format('d F') }}
                        </span>
                    </span>
                </p>
            </div>
            <br><div class="border-b border-gray-200 dark:border-dim-200"></div><br>
            
            <div class="pl-8 xl:pl-16 pr-4">
                <p class="font-medium text-gray-800 dark:text-white" style="word-wrap: break-word; word-break: break-word;">
                    {{ $replys->contenido }}
                </p>
                
                @if($replys->video_url)
                    <div class="feed_content_video">
                        <a href="{{ $replysn->video_url }}" target="_blank">{{ $replys->video_url }}</a>
                    </div>
                @endif
                @if($replys->isVideo())
                    <video controls>
                        <source src="{{ $replys->url_media }}" type="video/mp4">
                        Tu navegador no soporta la etiqueta de video.
                    </video>
                @else
                    <a href="{{$replys->url_media }}" target="_blank">
                        <img src="{{$replys->url_media }}" alt="" />
                    </a>
                @endif
            <br><br><br> <div class="border-b border-gray-200 dark:border-dim-200"></div><br>
                <div class="flex items-center w-full justify-between">
                    <div class="flex items-center dark:text-white text-xs text-gray-400 hover:text-blue-400 dark:hover:text-blue-400">
                        <i class="fa-solid fa-comment mr-2 text-lg"></i>
                        <a href="{{ route('comentario.showReply', ['id' => $replys->ID_comentario]) }}">
                            {{ optional($publicacion->comentarios)->count() ?? 0 }} respuestas
                        </a>
                    </div>
                    
                    <div class="flex items-center dark:text-white text-xs text-gray-400 hover:text-green-400 dark:hover:text-green-400">
                        @if ($replys->likes->where('ID_usuario', Auth::id())->isEmpty())
                            <form action="{{ route('like.publicacion', $replys>ID_comentario) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-like"><i class="fa-solid fa-heart mr-2 text-lg"></i>
                                    {{ $replys->likes->count() }}
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
@endif




@endsection