<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;
use App\Models\Publicacion;
use App\Models\Amistad;
use App\Models\Noticia;
use App\Models\Notificacion;
use App\Models\Carrera;
class PerfilController extends Controller
{
    public function show($id)
    {      

          

            
            $publicaciones = Publicacion::with('usuario')
                ->where('ID_usuario', $id)
                ->orderBy('created_at', 'desc')
                ->get();
                
            $perfil = Usuario::findOrFail($id);
            $sinnada=Publicacion::where('ID_usuario', $perfil->id)->count();
           
            $amistadPendiente = Amistad::where(function ($query) use ($id) {
                $query->where('ID_usuario', Auth::id())
                    ->where('ID_amigo', $id)
                    ->where('ID_estadoamistad', '1');
            })->orWhere(function ($query) use ($id) {
                $query->where('ID_usuario', $id)
                    ->where('ID_amigo', Auth::id())
                    ->where('ID_estadoamistad', '1');
            })->exists();

            $amistadExistente = Amistad::where(function ($query) use ($id) {
                $query->where('ID_usuario', Auth::id())
                    ->where('ID_amigo', $id)
                    ->where('ID_estadoamistad', '2');
            })->orWhere(function ($query) use ($id) {
                $query->where('ID_usuario', $id)
                    ->where('ID_amigo', Auth::id())
                    ->where('ID_estadoamistad', '2');
            })->exists();

            $amigoUser = Amistad::where(function ($query) use ($id) {
                $query->where('ID_usuario', Auth::id())
                    ->where('ID_amigo', $id);
            })->exists();

            $amigo = Amistad::where(function ($query) use ($id) {
                $query->where('ID_usuario', $id)
                    ->where('ID_amigo', Auth::id());
            })->exists();
            
            
            // Verifica si no existe una relación de amistad en ambas direcciones
        $noHayRelacion = !Amistad::where(function ($query) use ($id) {
            $query->where('ID_usuario', Auth::id())
                ->where('ID_amigo', $id);
        })->orWhere(function ($query) use ($id) {
            $query->where('ID_usuario', $id)
                ->where('ID_amigo', Auth::id());
        })->exists();

        // Verifica si no hay una solicitud de amistad pendiente en ambas direcciones
        $noHaySolicitudPendiente = !Amistad::where(function ($query) use ($id) {
            $query->where('ID_usuario', Auth::id())
                ->where('ID_amigo', $id)
                ->where('ID_estadoamistad', '1');
        })->orWhere(function ($query) use ($id) {
            $query->where('ID_usuario', $id)
                ->where('ID_amigo', Auth::id())
                ->where('ID_estadoamistad', '1');
        })->exists();

        // Determina si no hay relación en absoluto
        $noHayRelacionEntreEllos = $noHayRelacion && $noHaySolicitudPendiente;

        $noticias=Noticia::all();
        $solicitudes = Amistad::where('ID_amigo', Auth::id())
        ->where('ID_estadoamistad', 1) 
        ->with('usuario')
        ->get();
        $total= Notificacion::where('user2', Auth::user()->id)
        ->where('leido', false) // Filtrar solo las no leídas
        ->count();

        $carreras=Carrera::all();

        return view('Tecmunity.perfil', compact('carreras','total','solicitudes','noticias','perfil','sinnada', 'publicaciones', 'amistadPendiente', 'amistadExistente', 'amigoUser', 'amigo', 'noHayRelacionEntreEllos'));
    }
}