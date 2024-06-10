<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;
use App\Models\Publicacion;
use App\Models\Amistad;

class PerfilController extends Controller
{
    public function show($id)
    {
        $publicaciones = Publicacion::with('usuario')
            ->where('ID_usuario', $id)
            ->orderBy('created_at', 'desc')
            ->get();
        $perfil = Usuario::findOrFail($id);

        $amistades = Amistad::where('ID_usuario', $id)
            ->orWhere('ID_amigo', $id)
            ->get();
        return view('Tecmunity.perfil', compact('perfil', 'publicaciones', 'amistades'));
    }
}