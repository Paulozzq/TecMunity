<?php

namespace App\Http\Controllers;

use App\Models\Publicacion;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Auth;

use App\Models\Like;
class PublicacionController extends Controller
{
    public function index()
    {
        $publicaciones = Publicacion::with('usuario')->latest()->get();
       
        return view('Tecmunity.publicaciones', compact('publicaciones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'contenido' => 'required|string|max:255',
            'media' => 'nullable|file|mimes:jpg,jpeg,png,mp4,avi|max:20480',
            'video_url' => 'nullable|url'
        ]);

        $url = null;
        $public_id = null;
        $file = $request->file('media');

        if ($file) {
            $uploadedFile = Cloudinary::upload($file->getRealPath(), ['folder' => 'publicaciones']);
            $url = $uploadedFile->getSecurePath();
            $public_id = $uploadedFile->getPublicId();
        }

        Publicacion::create([
            'contenido' => $request->contenido,
            'url_media' => $url,
            'public_id' => $public_id,
            'video_url' => $request->video_url,
            'ID_usuario' => Auth::id(), // Asegúrate de que se asigne el usuario autenticado
        ]);

        return redirect()->route('publicaciones.index');
    }

    public function update(Request $request, Publicacion $publicacion)
    {
        $this->authorize('update', $publicacion);

        $request->validate([
            'contenido' => 'required|string|max:255',
            'media' => 'nullable|file|mimes:jpg,jpeg,png,mp4,avi|max:20480',
            'video_url' => 'nullable|url'
        ]);

        $url = $publicacion->url_media;
        $public_id = $publicacion->public_id;
        $file = $request->file('media');

        if ($file) {
            Cloudinary::destroy($public_id);
            $uploadedFile = Cloudinary::upload($file->getRealPath(), ['folder' => 'publicaciones']);
            $url = $uploadedFile->getSecurePath();
            $public_id = $uploadedFile->getPublicId();
        }

        $publicacion->update([
            'contenido' => $request->contenido,
            'url_media' => $url,
            'public_id' => $public_id,
            'video_url' => $request->video_url
        ]);

        return redirect()->route('publicaciones.index');
    }
    private function deleteComments($comentarios)
    {
        foreach ($comentarios as $comentario) {
            // Elimina las respuestas recursivamente
            $this->deleteComments($comentario->children);

            // Elimina el comentario
            $comentario->delete();
        }
    }
    public function destroy(Publicacion $publicacion)
    {
        if (Auth::id() !== $publicacion->ID_usuario) {
            return redirect()->route('publicaciones.index')->with('error', 'No tienes permiso para eliminar esta publicación');
        }
        $this->deleteComments($publicacion->comentarios);
        Like::where('ID_publicacion', $publicacion->ID_publicacion)->delete();
        
        $publicacion->delete();

        return redirect()->route('publicaciones.index');
    }
}
