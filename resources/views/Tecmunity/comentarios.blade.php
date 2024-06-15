@extends('main')

@section('title', 'Tecmunity')

@section('contenido')
    <div class="right_row">
        <div class="row border-radius">
            <div class="feed">
                <div class="feed_title">
                    <span><a href="{{ route('publicaciones.index') }}" class="back-button"><i class="fa fa-arrow-left"></i></a><b style="margin-left: 20px">Post</b></span>
                </div>
            </div>  
        </div>

        <div class="row border-radius">
            <div class="feed">
                <div class="feed_title">
                    <a href="{{ route('perfil.show', ['id' => $publicacion->usuario->id]) }}">
                        @if($publicacion->usuario->avatar)
                            <img src="{{ $publicacion->usuario->avatar }}" />
                        @else
                            <img src="{{ asset('img/default-avatar.jpg') }}"/>
                        @endif
                    </a>
                    <span>
                        <a href="{{ route('perfil.show', ['id' => $publicacion->usuario->id]) }}"><b>{{ $publicacion->usuario->nombre }} {{ $publicacion->usuario->apellido }}</b></a> compartió 
                        @if($publicacion->url_media)
                            <a href="{{ route('perfil.show', ['id' => $publicacion->usuario->id]) }}">{{ $publicacion->isVideo() ? 'un video' : 'una foto' }}</a>
                        @else
                            <a href="{{ route('perfil.show', ['id' => $publicacion->usuario->id]) }}">una publicación</a>
                        @endif
                        <br>
                        <p>{{ $publicacion->created_at->format('d F \a\t h:i A') }}</p>
                    </span>
                </div>
                <div class="feed_content">
                    @if($publicacion->url_media)
                        <div class="feed_content_image">
                            @if($publicacion->isVideo())
                                <video controls style="max-width: 500px; max-height: 500px;">
                                    <source src="{{ $publicacion->url_media }}" type="video/mp4">
                                    Tu navegador no soporta la etiqueta de video.
                                </video>
                            @else
                                <a href="{{ $publicacion->url_media }}" target="_blank">
                                    <img src="{{ $publicacion->url_media }}" alt="" style="max-width: 500px; max-height: 500px; display: block; margin-top: 10px;" />
                                </a>
                            @endif
                        </div>
                    @endif
                    <div class="feed_content_image">
                        <p>{{ $publicacion->contenido }}</p>
                    </div>
                    @if($publicacion->video_url)
                        <div class="feed_content_video">
                            <a href="{{ $publicacion->video_url }}" target="_blank">{{ $publicacion->video_url }}</a>
                        </div>
                    @endif
                </div>
                <div class="feed_footer">
                    <ul class="feed_footer_left">
                        <li class="hover-orange selected-orange">
                        @if ($publicacion->likes->where('ID_usuario', Auth::id())->isEmpty())
                            <form action="{{ route('like.publicacion', $publicacion->ID_publicacion) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-like"><i class="fa fa-heart-o"></i> 
                            {{ $publicacion->likes->count() }}</button>
                            </form>
                        @else
                            <form action="{{ route('unlike.publicacion', $publicacion->ID_publicacion) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-unlike"><i class="fa fa-heart"></i> 
                            {{ $publicacion->likes->count() }}</button>
                            </form>
                        @endif
                        </li>
                    </ul>
    
                        <ul class="feed_footer_right">
                            <li class="hover-orange selected-orange"><i class="fa fa-share"></i> 7k</li>
                            <a href="{{ route('comentario.show', ['id' => $publicacion->ID_publicacion]) }}" style="color:#515365;">
                                <li class="hover-orange"><i class="fa fa-comments-o"></i> {{ $publicacion->comentarios()->whereNull('reply')->count() }} comentarios</li>
                            </a>
                        </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="publish">
                <div class="row_title">
                    <span><i class="fa fa-newspaper-o" aria-hidden="true"></i> Comentar</span>
                </div>
                <form method="POST" action="{{ route('comentarios.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="publicacion_id" value="{{ $publicacion->ID_publicacion }}">
                    <div class="publish_textarea">
                        @if(auth()->user()->avatar)
                            <img class="border-radius-image" src="{{ auth()->user()->avatar }}" alt="Avatar" />
                        @else
                            <img class="border-radius-image" src="{{ asset('img/default-avatar.jpg') }}" alt="Avatar" />
                        @endif
                        <textarea name="contenido" placeholder="¿Qué opinas, {{ auth()->user()->nombre }}?" style="resize: none;"></textarea>
                    </div>
                    <div class="publish_icons">
                        <ul>
                            <li>
                                <input type="file" name="media" accept="image/*,video/*" style="display: none;" id="input-media" onchange="previewMedia(event)">
                                <label for="input-media">
                                    <i class="fa fa-camera"></i>
                                </label>
                            </li>
                        </ul>
                        <button type="submit">Publicar</button>
                    </div>
                    <div id="media-preview" style="margin-top: 10px;"></div>
                </form>
            </div>
        </div>

        @foreach($comentarios as $comentario)
            <div class="row border-radius">
                <div class="feed">
                    <div class="feed_title">
                        <a href="{{ route('perfil.show', ['id' => $comentario->usuario->id]) }}">
                            @if($comentario->usuario->avatar)
                                <img src="{{ $comentario->usuario->avatar }}" />
                            @else
                                <img src="{{ asset('img/default-avatar.jpg') }}"/>
                            @endif
                        </a>
                        <span>
                            <a href="{{ route('perfil.show', ['id' => $comentario->usuario->id]) }}"><b>{{ $comentario->usuario->nombre }} {{ $comentario->usuario->apellido }}</b></a>
                            <br>
                            <p>{{ $comentario->created_at->format('d F \a\t h:i A') }}</p>
                        </span>
                    </div>
                    <div class="feed_content">
                        <div class="feed_content_image">
                            <p>{{ $comentario->contenido }}</p>
                        </div>
                        @if($comentario->url_media)
                            <div class="feed_content_image">
                                @if($comentario->isVideo())
                                    <video controls style="max-width: 500px; max-height: 500px;">
                                        <source src="{{ $comentario->url_media }}" type="video/mp4">
                                        Tu navegador no soporta la etiqueta de video.
                                    </video>
                                @else
                                    <a href="{{ $comentario->url_media }}" target="_blank">
                                        <img src="{{ $comentario->url_media }}" alt="" style="max-width: 500px; max-height: 500px; display: block; margin-top: 10px;" />
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>
                    <div class="feed_footer">
                        <ul class="feed_footer_left">
                            <li class="hover-orange selected-orange">
                                @if ($comentario->likes->where('ID_usuario', Auth::id())->isEmpty())
                                    <form action="{{ route('like.comentario', $comentario->ID_comentario) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-like">
                                            <i class="fa fa-heart-o"></i>
                                            {{ $comentario->likes->count() }}
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('unlike.comentario', $comentario->ID_comentario) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-unlike">
                                            <i class="fa fa-heart"></i>
                                            {{ $comentario->likes->count() }}
                                        </button>
                                    </form>
                                @endif
                            </li>
                        </ul>

                        <ul class="feed_footer_right">
                            <li class="hover-orange selected-orange"><i class="fa fa-share"></i> 7k</li>
                            <a href="{{ route('comentario.showReply', ['id' => $comentario->ID_comentario]) }}" style="color:#515365;">
                                <li class="hover-orange"><i class="fa fa-comments-o"></i> {{ $publicacion->comentarios()->where('reply', $comentarios->ID_comentario)->whereNotNull('reply')->count() }} comentarios</li>
                            </a>
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach


        <script>
            function previewMedia(event) {
                var input = event.target;
                var preview = document.getElementById('media-preview');
        
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
        
                    reader.onload = function(e) {
                        var fileType = input.files[0].type.split('/')[0];
                        if (fileType === 'image') {
                            preview.innerHTML = '<img src="' + e.target.result + '" alt="Preview" style="max-width: 100%; max-height: 200px;">';
                        } else {
                            preview.innerHTML = '<video controls style="max-width: 100%; max-height: 200px;"><source src="' + e.target.result + '" type="' + input.files[0].type + '">Tu navegador no soporta la etiqueta de video.</video>';
                        }
                    }
        
                    reader.readAsDataURL(input.files[0]);
                } else {
                    preview.innerHTML = '';
                }
            }
        </script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $(document).on('submit', '.like-form, .unlike-form', function(e) {
        e.preventDefault();

        var form = $(this);
        var url = form.attr('action');
        var method = form.attr('method');
        var likeCountSpan = form.find('.like-count');
        var likeIcon = form.find('i');

        $.ajax({
            type: method,
            url: url,
            data: form.serialize(),
            success: function(response) {
                if (response.success) {
                    if (form.hasClass('like-form')) {
                        likeIcon.removeClass('fa-heart-o').addClass('fa-heart');
                        form.attr('action', form.attr('action').replace('like', 'unlike'));
                        form.removeClass('like-form').addClass('unlike-form');
                    } else {
                        likeIcon.removeClass('fa-heart').addClass('fa-heart-o');
                        form.attr('action', form.attr('action').replace('unlike', 'like'));
                        form.removeClass('unlike-form').addClass('like-form');
                    }
                    likeCountSpan.text(response.likesCount);
                }
            }
        });
    });
});
</script>

@endsection