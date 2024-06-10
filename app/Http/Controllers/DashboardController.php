<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Usuario;
use App\Models\Denuncia;

class DashboardController extends Controller
{
    public function index()
    {
        // Obtener el número de usuarios
        $numeroUsuarios = DB::table('usuarios')->count();

        // Obtener los nombres de las columnas de la tabla publicaciones
        $numeroPublicaciones = DB::table('publicaciones')->count();

        // Obtiene el numero de los comentarios
        $numeroComentarios = DB::table('comentarios')->count();

        // Obtiene el numero de carreras registradas
        $numeroCarreras = DB::table('carreras')->count();

        // Obtener el número de usuarios registrados por mes
        $usuariosPorMes = DB::table('usuarios')
            ->select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        // Pasar los datos a la vista del dashboard
        return view('dashboard', [
            'title' => 'Dashboard',
            'numeroUsuarios' => $numeroUsuarios,
            'numeroPublicaciones' => $numeroPublicaciones,
            'numeroComentarios' => $numeroComentarios,
            'numeroCarreras' => $numeroCarreras,
            'usuariosPorMes' => $usuariosPorMes
        ]);
    }


    public function index_list()
    {
        $usuarios = Usuario::all();
        return view('dashboard.dashboard-user', compact('usuarios'));
    }

    public function show($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('dashboard.show', compact('usuario'));
    }

    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('dashboard.edit', compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->update($request->all());

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado exitosamente');
    }

    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado exitosamente');
    }

    public function index_tick(){
        $denuncias = Denuncia::all();
        return view('dashboard.denuncias-list', compact('denuncias'));
    }

    public function show_tick(Denuncia $denuncia)
    {
        return view('dashboard.denuncias-list', compact('denuncia'));
    }

    public function destroy_tick(Denuncia $denuncia)
    {
        $denuncia->delete();
        return redirect()->route('dashboard.denuncias-list')->with('success', 'Denuncia eliminada exitosamente.');
    }

    public function aprobado_tick(Denuncia $denuncia)
    {
        $denuncia->status = 'aprobada';
        $denuncia->fecha_de_aprobacion = now();
        $denuncia->save();

        return redirect()->route('dashboard.denuncias-list')->with('success', 'Denuncia aprobada exitosamente.');
    }

    public function desaprobado_tick(Denuncia $denuncia)
    {
        $denuncia->status = 'rechazada';
        $denuncia->save();

        return redirect()->route('dashboard.denuncias-list')->with('success', 'Denuncia rechazada exitosamente.');
    }


}
