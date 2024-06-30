<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Amistad;
use App\Models\Notificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AmistadController extends Controller
{
    public function seguir($id)
    {
        if (!is_numeric($id) || Auth::id() == $id) {
            return response()->json(['error' => 'ID de usuario inválido'], 400);
        }

        $perfil = Usuario::find($id);

        if (!$perfil) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        $seguimientoExistente = Amistad::where(function ($query) use ($id) {
            $query->where('ID_usuario', Auth::id())
                  ->where('ID_amigo', $id);
        })->orWhere(function ($query) use ($id) {
            $query->where('ID_usuario', $id)
                  ->where('ID_amigo', Auth::id());
        })->exists();

        if ($seguimientoExistente) {
            return response()->json(['error' => 'Ya sigues a este usuario'], 400);
        }

        $amistad = Amistad::create([
            'ID_usuario' => Auth::id(),
            'ID_amigo' => $id,
            'fecha' => now(),
            'ID_estadoamistad' => 1,
        ]);
        Notificacion::create([
            'user1' => Auth::id(),
            'user2' => $id,
            'ID_tiponotificacion' => 2,
            'leido' => false,
            'fecha' => now(),
        ]);

        return response()->json(['success' => 'Ahora sigues a este usuario'], 200);
    }

    public function SeguirDeVuelta($id)
    {
        $mutuoSeguidor = Amistad::where('ID_usuario', $id)
                                ->where('ID_amigo', Auth::id())
                                ->where('ID_estadoamistad', 1)
                                ->exists();

        if ($mutuoSeguidor) {
            Amistad::where('ID_usuario', Auth::id())
                   ->where('ID_amigo', $id)
                   ->update(['ID_estadoamistad' => 2]);
            Amistad::where('ID_usuario', $id)
                   ->where('ID_amigo', Auth::id())
                   ->update(['ID_estadoamistad' => 2]);
        }

        Notificacion::create([
            'user1' => Auth::id(),
            'user2' => $id,
            'ID_tiponotificacion' => 3,
            'leido' => false,
            'fecha' => now(),
        ]);

        return response()->json(['success' => 'Ahora sigues a este usuario'], 200);
    }

    public function dejarDeSeguir($id)
    {
        $amistad = Amistad::where(function ($query) use ($id) {
            $query->where('ID_usuario', Auth::id())
                  ->where('ID_amigo', $id);
        })->orWhere(function ($query) use ($id) {
            $query->where('ID_usuario', $id)
                  ->where('ID_amigo', Auth::id());
        })->first();

                          
        if ($amistad) {
            $amistad->delete();
        }

        return response()->json(['success' => 'Has dejado de seguir a este usuario'], 200);
    }

    public function checkFriendshipStatus($id)
    {
        $amistadPendiente = Amistad::where(function ($query) use ($id) {
            $query->where('ID_usuario', Auth::id())
                ->where('ID_amigo', $id)
                ->where('ID_estadoamistad', 1);
        })->exists();

        $amistadPendienteParaAmigo = Amistad::where(function ($query) use ($id) {
            $query->where('ID_usuario', $id)
                ->where('ID_amigo', Auth::id())
                ->where('ID_estadoamistad', 1);
        })->exists();

        $amistadExistente = Amistad::where(function ($query) use ($id) {
            $query->where('ID_usuario', Auth::id())
                ->where('ID_amigo', $id)
                ->where('ID_estadoamistad', 2);
        })->orWhere(function ($query) use ($id) {
            $query->where('ID_usuario', $id)
                ->where('ID_amigo', Auth::id())
                ->where('ID_estadoamistad', 2);
        })->exists();

        return response()->json([
            'amistadPendiente' => $amistadPendiente,
            'amistadPendienteParaAmigo' => $amistadPendienteParaAmigo,
            'amistadExistente' => $amistadExistente
        ]);
    }
}
