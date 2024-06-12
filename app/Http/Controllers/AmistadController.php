<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Amistad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AmistadController extends Controller
{
    public function seguir($id)
    {
        // Validar que el ID del usuario sea numérico y diferente al usuario autenticado
        if (!is_numeric($id) || Auth::id() == $id) {
            return response()->json(['error' => 'ID de usuario inválido'], 400);
        }

        // Buscar el perfil del usuario, fallar si no se encuentra
        $perfil = Usuario::find($id);
        if (!$perfil) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        // Verificar que no existe ya una relación de seguimiento
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

        // Crear la relación de seguimiento
        $amistad = Amistad::create([
            'ID_usuario' => Auth::id(),
            'ID_amigo' => $id,
            'fecha' => now(),
            'estado' => 'pendiente'
        ]);

        return redirect()->route('perfil.show', ['id' => $id])->with('success', 'Ahora sigues a este usuario');
    }

    public function SeguirDeVuelta($id){
        // Verificar si el otro usuario ya lo sigue para establecer amistad
        $mutuoSeguidor = Amistad::where('ID_usuario', $id)
                                ->where('ID_amigo', Auth::id())
                                ->where('estado', 'pendiente' )
                                ->exists();

        if ($mutuoSeguidor) {
            Amistad::where('ID_usuario', Auth::id())
                   ->where('ID_amigo', $id)
                   ->update(['estado' => 'amigos']);
            Amistad::where('ID_usuario', $id)
                   ->where('ID_amigo', Auth::id())
                   ->update(['estado' => 'amigos']);
        }

        // Redirigir a la vista de perfil con un mensaje de éxito
        return redirect()->route('perfil.show', ['id' => $id])->with('success', 'Ahora sigues a este usuario');
    }

    public function dejarDeSeguir($id)
    {
    // Obtener la relación de seguimiento existente
    $amistad = Amistad::where('ID_usuario', Auth::id())
    ->where('ID_amigo', $id)
    ->first();
    // Verificar si la relación existe
    if ($amistad) {
        $amistad->delete();
    }

    // Redirigir de regreso al perfil del usuario
    return redirect()->back()->with('success', 'Has dejado de seguir a este usuario');
    }

}
