<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Denuncia;
use App\Models\TipoDenuncia;
use App\Models\Noticias;
use App\Models\Amistad;
use App\Models\Usuario;


class DenunciaController extends Controller
{
    public function create()
    {
        $tiposDenuncias = TipoDenuncia::all();
        $noticias=Noticias::all();
        $solicitudes = Amistad::where('ID_amigo', Auth::id())
        ->where('ID_estadoamistad', 1) // Estado pendiente
        ->with('usuario')
        ->get();

        $usuarios=Usuarios::all();
        return view('Tecmunity.publicaciones', compact('usuarios','solicitudes','noticias','tiposDenuncias'));
    }

    public function store(Request $request)
    {
        try {
            
            $validatedData = $request->validate([
                'denunciado' => 'required|exists:usuarios,id',
                'contenido' => 'required|string',
                'ID_tipodenuncia' => 'required|exists:tiposdenuncias,ID_tipodenuncia',
                'publicacion' => 'nullable|exists:publicaciones,ID_publicacion',
                'ID_estadodenuncia' => 'sometimes|exists:estadosdenuncias,ID_estadodenuncia',
                'fecha_de_aprobacion' => 'nullable|date', 
            ]);
            

           
            
    
           
            $denunciante = auth()->user()->id;
    
        
            $denuncia = Denuncia::create([
                'denunciado' => $validatedData['denunciado'],
                'denunciante' => $denunciante,
                'publicacion' => $validatedData['publicacion'], 
                'contenido' => $validatedData['contenido'],
                'ID_tipodenuncia' => $validatedData['ID_tipodenuncia'],
                'ID_estadodenuncia' => 1, 
                'fecha_de_aprobacion' => null, 
            ]);
          
            
    
            $nombreDenunciado = $denuncia->denunciado->nombreCompleto(); 
    
            return redirect()->back()->with('success', 'Denuncia enviada correctamente contra ' . $nombreDenunciado . '.');
        } catch (\Exception $e) {
            
            return back()->withErrors(['error' => 'Error al crear la denuncia: ' . $e->getMessage()]);
        }
    }
    
}
