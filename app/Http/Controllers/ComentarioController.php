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
        $idusua = Publicacion::findOrfail($request->publicacion_id);
        Notificacion::create([
            'user1' => Auth::id(),
            'user2' => $idusua->ID_usuario,
            'ID_tiponotificacion' => 1,
            'leido' => false,
            'fecha' => now(),
        ]);
        return redirect()->back();
    }

    public function reply(Request $request){
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
            'reply'=>$request->reply,
            'url_media' => $mediaUrl,
        ]);
        $idusua = Publicacion::findOrfail($request->publicacion_id);
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
        // Aquí puedes cargar la publicación desde la base de datos usando el ID proporcionado
        $publicacion = Publicacion::findOrFail($id);
        $comentarios = $publicacion->comentarios()

        
            ->whereNull('reply')
            ->latest()
            ->get(); 
        $noticias=Noticia::all();
        $solicitudes = Amistad::where('ID_amigo', Auth::id())
        ->where('ID_estadoamistad', 1) 
        ->with('usuario')
        ->get(); 
      
        return view('Tecmunity.comentarios', compact('noticias','publicacion', 'comentarios', 'solicitudes'));
        
    }
   

    public function showReply($id)
    {
        // Cargar el comentario principal
        $comentarios = Comentario::findOrFail($id);
        $noticias=Noticia::all();
        
        
        
        $user = $comentarios->usuario;
        $publicacion = $comentarios->publicacion; 
        // Obtener las respuestas (subcomentarios) del comentario
        $reply = $comentarios->children()->latest()->get();
        return view('Tecmunity.reply', compact( 'noticias','comentarios','user', 'publicacion', 'reply'));
    }
}
