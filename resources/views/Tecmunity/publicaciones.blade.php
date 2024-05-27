@extends('main')

@section('title', 'Tecmunity')

@section('contenido')
<div class="right_row">
    <div class="row">
        <div class="publish">
            <div class="row_title">
                <span><i class="fa fa-newspaper-o" aria-hidden="true"></i> Status</span>
            </div>
            <form method="POST" action="{{ route('publicaciones.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="publish_textarea">
                    <img class="border-radius-image" src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('img/default-avatar.png') }}" alt="" />
                    <textarea name="contenido" placeholder="¿Algo que decir, {{ auth()->user()->nombre }}?" style="resize: none;"></textarea>
                </div>
                <div class="publish_icons">
                    <ul>
                        <li>
                            <input type="file" name="media" accept="image/*,video/*" style="display: none;" id="input-media" onchange="previewMedia(event)">
                            <label for="input-media">
                                <i class="fa fa-camera"></i>
                            </label>
                        </li>
                        <li>
                            <input type="url" name="video_url" placeholder="Video URL" style="display: none;" id="input-video-url" onchange="showVideoPreview(event)">
                            <label for="input-video-url">
                                <i class="fa fa-video-camera"></i>
                            </label>
                        </li>
                    </ul>
                    <button type="submit">Publish</button>
                </div>
                <div id="media-preview" style="margin-top: 10px;"></div>
            </form>
        </div>
    </div>
    @foreach($publicaciones as $publicacion)
        <div class="row border-radius">
            <div class="feed">
                <div class="feed_title">
                    <img src="{{ Storage::url($publicacion->usuario->avatar) }}" alt="" />
                    <span>
                        <b>{{ $publicacion->usuario->nombre }} {{ $publicacion->usuario->apellido }}</b> shared a 
                        @if($publicacion->url_media)
                            <a href="feed.html">{{ $publicacion->isVideo() ? 'video' : 'photo' }}</a>
                        @else
                            post
                        @endif
                        <br>
                        <p>{{ $publicacion->created_at->format('F d \a\t h:i A') }}</p>
                    </span>
                </div>
                <div class="feed_content">
                    @if($publicacion->url_media)
                        <div class="feed_content_image">
                            @if($publicacion->isVideo())
                                <video controls>
                                    <source src="{{ Storage::url($publicacion->url_media) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            @else
                                <a href="feed.html"><img src="{{ Storage::url($publicacion->url_media) }}" alt="" /></a>
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
                        <li class="hover-orange selected-orange"><i class="fa fa-heart"></i> {{ $publicacion->nro_likes }}</li>
                        <li><span><b>{{ $publicacion->usuario->nombre }}</b> and others liked this</span></li>
                    </ul>
                    <ul class="feed_footer_right">
                        <li class="hover-orange selected-orange"><i class="fa fa-share"></i> 7k</li>
                        <a href="feed.html" style="color:#515365;">
                            <li class="hover-orange"><i class="fa fa-comments-o"></i> 74 comments</li>
                        </a>
                    </ul>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="suggestions_row">
    <div class="row shadow">
        <div class="row_title">
            <span>Friend Suggestions</span>
            <a href="friends.html">see more..</a>
        </div>
        <div class="row_contain">
            <img src="images/user-7.jpg" alt="" />
            <span><b>Francine Smith</b><br>8 Friends in Common</span>
            <button>+</button>
        </div>
        <div class="row_contain">
            <img src="images/user-2.jpg" alt="" />
            <span><b>Hugh Wilson</b><br>6 Friends in Common</span>
            <button>+</button>
        </div>
        <div class="row_contain">
            <img src="images/user-6.jpg" alt="" />
            <span><b>Karen Masters</b><br>6 Friends in Common</span>
            <button>+</button>
        </div>
    </div>
</div>

<script>
    function previewMedia(event) {
        var previewContainer = document.getElementById('media-preview');
        previewContainer.innerHTML = ''; // Clear previous previews
        var file = event.target.files[0];

        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var previewElement;
                if (file.type.startsWith('image/')) {
                    previewElement = document.createElement('img');
                    previewElement.src = e.target.result;
                    previewElement.style.maxWidth = '200px';
                    previewElement.style.maxHeight = '200px';
                    previewElement.style.display = 'block';
                    previewElement.style.marginTop = '10px';
                } else if (file.type.startsWith('video/')) {
                    previewElement = document.createElement('video');
                    previewElement.src = e.target.result;
                    previewElement.controls = true;
                    previewElement.style.maxWidth = '200px';
                    previewElement.style.maxHeight = '200px';
                    previewElement.style.display = 'block';
                    previewElement.style.marginTop = '10px';
                }
                previewContainer.appendChild(previewElement);
            };
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection