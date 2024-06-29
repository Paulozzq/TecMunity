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
                    <form  action="#" method="POST">
                        @csrf
                        <button type="submit" class="bg-blue-500/20 border-2 border-blue-500 text-white hover:bg-blue-500 hover:text-white font-bold py-2 px-4 rounded-full shadow-lg transition duration-300 ease-in-out">Editar Perfil</button>
                    </form>
                    @endif
        </div>
        <p class="text-gray-400 dark:text-gray-200">{{ $perfil->biografia }}</p>
    </div>
</div>

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
        <span class="bg-black dark:bg-gray-800 px-4 text-gray-500">Publicaciones de {{$perfil->nombre}}</span>
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
                </span>
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
            <br><br><br>
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
                <div class="flex items-center dark:text-white text-xs text-gray-400 hover:text-blue-400 dark:hover:text-blue-400">
                    <i class="fa-solid fa-flag mr-2 text-lg"></i>
                </div>
            </div>
        </div>
    </a>
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
