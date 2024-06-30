<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo;
use App\Models\PublicacionGrupo;
use Illuminate\Support\Facades\Auth;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use App\Models\Usuario;
use App\Models\Amistad;

class PublicacionGrupoController extends Controller
{
    public function index(Grupo $grupo)
    {
        $publicaciones = $grupo->publicaciones()->with('usuario')->latest()->get();
        $usuarios = Usuario::whereHas('grupos', function ($query) use ($grupo) {
            $query->where('ID_grupos', $grupo->ID_grupos);
        })->get();
        $solicitudes = Amistad::where('ID_amigo', Auth::id())
        ->where('ID_estadoamistad', 1) 
        ->with('usuario')
        ->get();
        
        return view('Tecmunity.gruposVista', compact('solicitudes','grupo', 'publicaciones', 'usuarios'));
    }



    public function store(Request $request, Grupo $grupo)
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

        $publicacion = PublicacionGrupo::create([
            'contenido' => $request->contenido,
            'url_media' => $url,
            'public_id' => $public_id,
            'video_url' => $request->video_url,
            'ID_usuario' => Auth::id(), // Asegúrate de que se asigne el usuario autenticado
            'ID_grupo' => $grupo->ID_grupos,
        ]);

        return redirect()->route('grupos.publicaciones.index', $grupo->ID_grupos)
                         ->with('success', 'Publicación creada exitosamente.');
    }

    public function update(Request $request, Grupo $grupo, PublicacionGrupo $publicacion)
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

        return redirect()->route('grupos.publicaciones.index', $grupo->ID_grupos)
                         ->with('success', 'Publicación actualizada exitosamente.');
    }

    public function destroy(Grupo $grupo, PublicacionGrupo $publicacion)
    {
        $this->authorize('delete', $publicacion);

        Cloudinary::destroy($publicacion->public_id);
        $publicacion->delete();

        return redirect()->route('grupos.publicaciones.index', $grupo->ID_grupos)
                         ->with('success', 'Publicación eliminada exitosamente.');
    }
}
