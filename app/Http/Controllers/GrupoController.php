<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo;
use App\Models\Grupousuario;
use App\Models\Carrera; // Asegúrate de importar el modelo Carrera
use App\Models\InfoGrupo; // Asegúrate de importar el modelo Usuario si aún no lo has hecho
use App\Models\PublicacionGrupo;
use Illuminate\Support\Facades\Auth;

class GrupoController extends Controller
{
    /**
     * Muestra el formulario para crear un nuevo grupo.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $carreras = Carrera::all(); // Obtener todas las carreras
        $grupos = Grupo::all();
        return view('Tecmunity.grupos', compact('carreras','grupos'));
    }

    /**
     * Almacena un grupo recién creado en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'ID_carrera' => 'required|exists:carreras,ID_carrera', // Asegurarse de que la carrera existe
        ]);

        // Crear el grupo
        $grupo = Grupo::create([
            'nombre' => $validated['nombre'],
            'Fecha_creacion' => now(),
            'ID_creador' => Auth::id(), // Usar el ID del usuario autenticado
            'ID_carrera' => $validated['ID_carrera'],
        ]);

        // Redirigir a una ruta específica con un mensaje de éxito
        return redirect()->back()->with('success', 'Grupo creado exitosamente.');
    }
    public function join(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'ID_grupo' => 'required|exists:grupos,ID_grupos',
        ]);

    

        // Crear la relación en la tabla usuariosgrupos
        Grupousuario::create([
            'ID_usuario' => Auth::id(), // Usar el ID del usuario autenticado
            'ID_grupo' => $validated['ID_grupo'],
            'fecha' => now(),
        ]);

        // Redirigir a una ruta específica con un mensaje de éxito
        return redirect()->route('grupos.create')->with('success', 'Te has unido al grupo exitosamente.');
    }

    public function index($id){
        $grupos = Grupo::findOrFail($id);
        $info = Grupo::with('InfoGrupo')->findOrFail($id);
        $publicaciones = PublicacionGrupo::where('ID_grupo', $id)->get();
        return view('Tecmunity.gruposVista', compact('grupos'));
    }
}
