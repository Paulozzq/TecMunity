<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Amistad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AmistadController extends Controller
{
    public function AmistadAction($id)
    {
        // Validar que el ID del usuario sea numérico
        if (!is_numeric($id)) {
            return response()->json(['error' => 'ID de usuario inválido'], 400);
        }

        // Verificar que el usuario no está intentando hacerse amigo de sí mismo
        if (Auth::id() == $id) {
            return response()->json(['error' => 'No puedes enviarte una solicitud de amistad a ti mismo'], 400);
        }

        // Buscar el perfil del usuario, fallar si no se encuentra
        $perfil = Usuario::find($id);
        if (!$perfil) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        // Verificar que no existe ya una relación de amistad
        $amistadExistente = Amistad::where('ID_usuario', Auth::id())
                                    ->where('ID_amigo', $id)
                                    ->orWhere('ID_usuario', $id)
                                    ->where('ID_amigo', Auth::id())
                                    ->exists();

        if ($amistadExistente) {
            return response()->json(['error' => 'Ya existe una solicitud de amistad o son amigos'], 400);
        }

        // Crear la relación de amistad
        $amistad = Amistad::create([
            'ID_usuario' => Auth::id(),
            'ID_amigo' => $id,
            'fecha' => now(),
            'estado' => 'pendiente'
        ]);

        // Redirigir a la vista de perfil con un mensaje de éxito
        return redirect()->route('perfil.show', ['id' => $id])->with('success', 'Solicitud de amistad enviada exitosamente');
    }
}
