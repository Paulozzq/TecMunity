<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario; // Assuming Usuario is your model for users/friends
use Illuminate\Support\Facades\Auth;
use App\Models\Amistad;

class MensajeriaController extends Controller
{
    public function show(){
        $userId = Auth::id();

        $ids1 = Amistad::where('ID_usuario', $userId)
            ->where('ID_estadoamistad', 2)
            ->pluck('ID_amigo');

        $ids2 = Amistad::where('ID_amigo', $userId)
            ->where('ID_estadoamistad', 2)
            ->pluck('ID_usuario');

        $allIds = $ids1->merge($ids2)->unique()->toArray();

        $usuarios = Usuario::whereIn('id', $allIds)->get();

        return view('Tecmunity.mensajeria', compact('usuarios'));
    }
}
