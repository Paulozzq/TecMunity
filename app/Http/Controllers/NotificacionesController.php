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
         ->where('ID_estadoamistad', 1) // Estado pendiente
         ->with('usuario')
         ->get(); 

        return view('Tecmunity.notificaciones', compact('solicitudes','noticias','notificaciones'));
    }
}
