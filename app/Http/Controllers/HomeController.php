<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Noticia; // Asegúrate de importar el modelo Noticia
use App\Models\Amistad;
use App\Models\Notificacion; // Asegúrate de importar el modelo Notificacion

class HomeController extends Controller
{
    public function index()
    {
        $noticias = Noticia::all(); // Obtener todas las noticias desde la base de datos
        $usuarios = Usuario::with('roles')->get();
        $solicitudes = Amistad::where('ID_amigo', Auth::id())
        ->where('ID_estadoamistad', 1) 
        ->with('usuario')
        ->get(); // Cargar la relación 'roles' de usuarios
        $total= Notificacion::where('user2', Auth::user()->id)
        ->where('leido', false) // Filtrar solo las no leídas
        ->count();

        return view('main', compact('total','solicitudes','noticias', 'usuarios'));
    }
    
}
