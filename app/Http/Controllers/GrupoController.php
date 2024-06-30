<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo;
use App\Models\Grupousuario;
use App\Models\Carrera; 
use App\Models\InfoGrupo;
use App\Models\PublicacionGrupo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Usuario;
use App\Models\Noticia;
use App\Models\Amistad;
use App\Models\Notificacion;

class GrupoController extends Controller
{
    /**
     * Muestra el formulario para crear un nuevo grupo.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $carreras = Carrera::all(); 
        $grupos = Grupo::all();
        $noticias=Noticia::all();
        $solicitudes = Amistad::where('ID_amigo', Auth::id())
        ->where('ID_estadoamistad', 1) // Estado pendiente
        ->with('usuario')
        ->get();
        $total= Notificacion::where('user2', Auth::user()->id)
        ->where('leido', false) // Filtrar solo las no leídas
        ->count();
        return view('Tecmunity.grupos', compact('total','solicitudes','noticias','carreras','grupos'));
    }

    /**
     * Almacena un grupo recién creado en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'ID_carrera' => 'required|exists:carreras,ID_carrera', 
        ]);

        // Crear el grupo
        $grupo = Grupo::create([
            'nombre' => $validated['nombre'],
            'Fecha_creacion' => now(),
            'ID_creador' => Auth::id(), 
            'ID_carrera' => $validated['ID_carrera'],
            
        ]);

    
        return redirect()->back()->with('success', 'Grupo creado exitosamente.');
    }
    public function join(Request $request)
{
    $validated = $request->validate([
        'ID_grupo' => 'required|exists:grupos,ID_grupos',
    ]);

    $grupo = Grupo::find($validated['ID_grupo']);

    $exists = Grupousuario::where('ID_usuario', Auth::id())
                          ->where('ID_grupo', $validated['ID_grupo'])
                          ->exists();

    if ($exists) {
        return redirect()->route('grupos.create')->with('sweetalert', 'Ya te uniste al grupo de ' . $grupo->nombre . '.');
    }

    try {
        DB::beginTransaction();

        // Crear la relación en la tabla Grupousuario
        Grupousuario::create([
            'ID_usuario' => Auth::id(),
            'ID_grupo' => $validated['ID_grupo'],
            'fecha' => now(),
        ]);

        DB::commit();

        return redirect()->route('grupos.create')->with('success', 'Te has unido al grupo exitosamente.');
    } catch (\Exception $e) {
        DB::rollback();
        return redirect()->route('grupos.create')->with('error', 'Error al unirse al grupo. Por favor, inténtalo de nuevo más tarde.');
    }
}

    public function index($id) {
        // Fetch the group details
        $grupo = Grupo::findOrFail($id);
        $infoGrupo = InfoGrupo::where('ID_grupo', $id)->first();
        $usuarios = Usuario::all();
        $publicaciones = PublicacionGrupo::where('ID_grupo', $id)->latest()->get();
        $noticias=Noticia::all();
        $solicitudes = Amistad::where('ID_amigo', Auth::id())
        ->where('ID_estadoamistad', 1) // Estado pendiente
        ->with('usuario')
        ->get();
        $total= Notificacion::where('user2', Auth::user()->id)
        ->where('leido', false) // Filtrar solo las no leídas
        ->count();
    
        return view('Tecmunity.gruposVista', compact('total','solicitudes','noticias','usuarios','grupo', 'infoGrupo', 'publicaciones'));
    }

    public function guardarInfoGrupo(Request $request, $id)
    {
        // Validación de los datos recibidos del formulario
        $validated = $request->validate([
            'descripcion' => 'nullable|string|max:255',
            'avatar' => 'nullable|url',
            'portada' => 'nullable|url',
            'tema' => 'nullable|string|max:255',
            'privado' => 'nullable|boolean',
        ]);
        
        try {
            DB::beginTransaction();
        
            // Buscar el grupo
            $grupo = Grupo::findOrFail($id);
        
            // Verificar si ya existe una entrada de InfoGrupo para este grupo
            $infoGrupo = InfoGrupo::where('ID_grupo', $id)->first();
        
            if ($infoGrupo) {
                // Si existe, actualizar los datos
                $infoGrupo->update($validated);
            } else {
                // Si no existe, crear una nueva entrada
                InfoGrupo::create(array_merge($validated, ['ID_grupo' => $id]));
            }
        
            DB::commit();

            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back();
        }
    }    
}
