<?php

namespace App\Http\Controllers;

use App\Models\ComentarioGrupo;
use App\Models\Grupo;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Auth;
use App\Models\Notificacion;

class ComentarioGrupoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'contenido' => 'required|string|max:255',
            'media' => 'nullable|file|mimes:jpg,jpeg,png,mp4,avi|max:20480',
        ]);

        $mediaUrl = null;
        if ($request->hasFile('media')) {
            $media = $request->file('media');
            $uploadedFile = Cloudinary::upload($media->getRealPath(), ['folder' => 'comentarios']);
            $mediaUrl = $uploadedFile->getSecurePath();
        }

        ComentarioGrupo::create([
            'contenido' => $request->contenido,
            'ID_usuario' => Auth::id(),
            'ID_grupo' => $request->grupo_id,
            'url_media' => $mediaUrl,
        ]);

        return redirect()->back();
    }

    public function reply(Request $request)
    {
        $request->validate([
            'contenido' => 'required|string|max:255',
            'media' => 'nullable|file|mimes:jpg,jpeg,png,mp4,avi|max:20480',
            'reply' => 'required|exists:comentarios_grupos,ID_comentario',
        ]);

        $mediaUrl = null;
        if ($request->hasFile('media')) {
            $media = $request->file('media');
            $uploadedFile = Cloudinary::upload($media->getRealPath(), ['folder' => 'comentarios']);
            $mediaUrl = $uploadedFile->getSecurePath();
        }

        ComentarioGrupo::create([
            'contenido' => $request->contenido,
            'ID_usuario' => Auth::id(),
            'ID_grupo' => $request->grupo_id,
            'reply' => $request->reply,
            'url_media' => $mediaUrl,
        ]);

        return redirect()->back();
    }

    public function show($id)
    {
        // Cargar el grupo desde la base de datos usando el ID proporcionado
        $grupo = Grupo::findOrFail($id);

        // Obtener los comentarios asociados al grupo
        $comentarios = $grupo->comentarios()->whereNull('reply')->latest()->get();
        $total= Notificacion::where('user2', Auth::user()->id)
        ->where('leido', false) // Filtrar solo las no leídas
        ->count();

        return view('Tecmunity.comentariosgrupos', compact('total','grupo', 'comentarios'));
    }

    public function showReply($id)
    {
        // Cargar el comentario principal
        $comentario = ComentarioGrupo::findOrFail($id);

        // Obtener las respuestas (subcomentarios) del comentario
        $respuestas = $comentario->respuestas()->latest()->get();
        $total= Notificacion::where('user2', Auth::user()->id)
        ->where('leido', false) // Filtrar solo las no leídas
        ->count();
        return view('Tecmunity.comentariosgrupos', compact('total','comentario', 'respuestas'));
    }
}
