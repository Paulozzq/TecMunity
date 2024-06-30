<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Noticia;
use App\Models\Amistad;
use Illuminate\Support\Facades\Auth;

class BuscadorController extends Controller
{


    public function index(){
        $noticias = Noticia::all();
        $solicitudes = Amistad::where('ID_amigo', Auth::id())
        ->where('ID_estadoamistad', 1) 
        ->with('usuario')
        ->get();
        return view('Tecmunity.busqueda', compact('solicitudes','noticias'));
    }
    public function buscar(Request $request)
    {
        $query = $request->input('query');

       
        $resultados = Usuario::where(function ($queryBuilder) use ($query) {
            $queryBuilder->where('nombre', 'like', '%' . $query . '%')
                         ->orWhere('apellido', 'like', '%' . $query . '%');
        })->limit(5)->get();

        return response()->json($resultados);
    }
}
