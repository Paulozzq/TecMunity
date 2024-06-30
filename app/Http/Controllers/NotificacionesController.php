<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notificacion;
use Illuminate\Support\Facades\Auth;
use App\Models\Noticia;
use App\Models\Amistad;

class NotificacionesController extends Controller
{
    public function show()
    {
        $notificaciones = Notificacion::where('user2', Auth::user()->id)
            ->orderBy('fecha', 'desc')
            ->paginate(5);

         $noticias=Noticia::all();  
         $solicitudes = Amistad::where('ID_amigo', Auth::id())
         ->where('ID_estadoamistad', 1) 
         ->with('usuario')
         ->get(); 

         $total= Notificacion::where('user2', Auth::user()->id)
         ->where('leido', false) // Filtrar solo las no leídas
         ->count();

        return view('Tecmunity.notificaciones', compact('total','solicitudes','noticias','notificaciones'));
    }

    
}
