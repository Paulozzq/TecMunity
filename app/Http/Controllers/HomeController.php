<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Noticia; // Asegúrate de importar el modelo Noticia
use App\Models\Amistad;

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
      
        return view('main', compact('solicitudes','noticias', 'usuarios'));
    }
    
}
