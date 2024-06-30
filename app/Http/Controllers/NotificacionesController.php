<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notificacion;
use Illuminate\Support\Facades\Auth;

class NotificacionesController extends Controller
{
    public function show()
    {
        $notificaciones = Notificacion::where('user2', Auth::user()->id)
            ->orderBy('fecha', 'desc')
            ->paginate(5);

        return view('Tecmunity.notificaciones', compact('notificaciones'));
    }
}
