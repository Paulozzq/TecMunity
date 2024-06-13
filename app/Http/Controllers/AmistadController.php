<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Amistad;
use Illuminate\Http\Request;
use App\Models\Notificacion;
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
            'estado' => 'pendiente'
        ]);

        return response()->json(['success' => 'Ahora sigues a este usuario'], 200);
    }

    public function SeguirDeVuelta($id)
    {
        $mutuoSeguidor = Amistad::where('ID_usuario', $id)
                                ->where('ID_amigo', Auth::id())
                                ->where('estado', 'pendiente')
                                ->exists();

        if ($mutuoSeguidor) {
            Amistad::where('ID_usuario', Auth::id())
                   ->where('ID_amigo', $id)
                   ->update(['estado' => 'amigos']);
            Amistad::where('ID_usuario', $id)
                   ->where('ID_amigo', Auth::id())
                   ->update(['estado' => 'amigos']);
        }

        return response()->json(['success' => 'Ahora sigues a este usuario'], 200);
    }

    public function dejarDeSeguir($id)
    {
        $amistad = Amistad::where('ID_usuario', Auth::id())
                          ->where('ID_amigo', $id)
                          ->first();
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
                ->where('estado', 'pendiente');
        })->exists();

        $amistadPendienteParaAmigo = Amistad::where(function ($query) use ($id) {
            $query->where('ID_usuario', $id)
                ->where('ID_amigo', Auth::id())
                ->where('estado', 'pendiente');
        })->exists();

        $amistadExistente = Amistad::where(function ($query) use ($id) {
            $query->where('ID_usuario', Auth::id())
                ->where('ID_amigo', $id)
                ->where('estado', 'amigos');
        })->orWhere(function ($query) use ($id) {
            $query->where('ID_usuario', $id)
                ->where('ID_amigo', Auth::id())
                ->where('estado', 'amigos');
        })->exists();

        return response()->json([
            'amistadPendiente' => $amistadPendiente,
            'amistadPendienteParaAmigo' => $amistadPendienteParaAmigo,
            'amistadExistente' => $amistadExistente
        ]);
    }

}
