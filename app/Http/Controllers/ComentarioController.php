<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Publicacion;
use App\Models\Notificacion;
use App\Models\Usuario;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Auth;
use App\Models\Noticia;
use App\Models\Amistad;
use App\Models\TipoDenuncia;

class ComentarioController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'contenido' => 'required|string|max:255',
            'media' => 'nullable|file|mimes:jpg,jpeg,png,mp4,avi|max:20480',
            'publicacion_id' => 'required|exists:publicaciones,ID_publicacion',
        ]);

        $mediaUrl = null;
        if ($request->hasFile('media')) {
            $media = $request->file('media');
            $uploadedFile = Cloudinary::upload($media->getRealPath(), ['folder' => 'comentarios']);
            $mediaUrl = $uploadedFile->getSecurePath();
        }

        $info = Comentario::create([
            'contenido' => $request->contenido,
            'ID_usuario' => Auth::id(),
            'ID_publicacion' => $request->publicacion_id,
            'url_media' => $mediaUrl,
        ]);

        $idusua = Publicacion::findOrFail($request->publicacion_id);
        Notificacion::create([
            'user1' => Auth::id(),
            'user2' => $idusua->ID_usuario,
            'ID_tiponotificacion' => 1,
            'leido' => false,
            'fecha' => now(),
        ]);

        return redirect()->back();
    }

    public function reply(Request $request)
    {
        $request->validate([
            'contenido' => 'required|string|max:255',
            'media' => 'nullable|file|mimes:jpg,jpeg,png,mp4,avi|max:20480',
            'reply' => 'required|exists:comentarios,ID_comentario',
        ]);

        $mediaUrl = null;
        if ($request->hasFile('media')) {
            $media = $request->file('media');
            $uploadedFile = Cloudinary::upload($media->getRealPath(), ['folder' => 'comentarios']);
            $mediaUrl = $uploadedFile->getSecurePath();
        }

        Comentario::create([
            'contenido' => $request->contenido,
            'ID_usuario' => Auth::id(),
            'ID_publicacion' => $request->publicacion_id,
            'reply' => $request->reply,
            'url_media' => $mediaUrl,
        ]);

        $idusua = Publicacion::findOrFail($request->publicacion_id);
        Notificacion::create([
            'user1' => Auth::id(),
            'user2' => $idusua->ID_usuario,
            'ID_tiponotificacion' => 5,
            'leido' => false,
            'fecha' => now(),
        ]);

        return redirect()->back();
    }

    public function show($id)
    {
        $publicacion = Publicacion::findOrFail($id);
        $comentarios = $publicacion->comentarios()
            ->whereNull('reply')
            ->latest()
            ->get();

        $noticias = Noticia::all();
        $solicitudes = Amistad::where('ID_amigo', Auth::id())
            ->where('ID_estadoamistad', 1)
            ->with('usuario')
            ->get();

        $total = Notificacion::where('user2', Auth::id())
            ->where('leido', false)
            ->count();

            $usuarios=Usuario::all();
           $publicaciones=Publicacion::all();

           $tiposDenuncias = TipoDenuncia::all();


        return view('Tecmunity.comentarios', compact('tiposDenuncias','publicaciones','usuarios','total', 'solicitudes', 'noticias', 'publicacion', 'comentarios'));
    }

    public function showReply($id)
    {
        $comentario = Comentario::findOrFail($id);
        $noticias = Noticia::all();
        $user = $comentario->usuario;
        $publicacion = $comentario->publicacion;
        $reply = $comentario->children()->latest()->get();

        $total = Notificacion::where('user2', Auth::id())
            ->where('leido', false)
            ->count();

        return view('Tecmunity.reply', compact('total', 'noticias', 'comentario', 'user', 'publicacion', 'reply'));
    }
}

