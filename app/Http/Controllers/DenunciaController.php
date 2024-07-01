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
    public function store(Request $request)
    {
        // Validación de los datos recibidos del formulario
        $validatedData = $request->validate([
            'denunciado' => 'required',
            'publicacion' => 'required',
            'ID_tipodenuncia' => 'required',
            'contenido' => 'required',
        ]);

        // Aquí asumo que $denunciante ya está definido en tu controlador antes de este punto

        try {
            // Crear la denuncia
            $denuncia = Denuncia::create([
                'denunciado' => $validatedData['denunciado'],
                'denunciante' => $denunciante, // Ajusta esto según cómo obtienes al denunciante
                'publicacion' => $validatedData['publicacion'],
                'contenido' => $validatedData['contenido'],
                'ID_tipodenuncia' => $validatedData['ID_tipodenuncia'],
                'ID_estadodenuncia' => 1, // ID del estado de la denuncia, ajusta según tu lógica
                'fecha_de_aprobacion' => null, // Ajusta según tu lógica de negocio
            ]);

            // Redireccionar u otra lógica después de crear la denuncia
            return redirect()->back()->with('success', 'Denuncia enviada exitosamente.');

        } catch (\Exception $e) {
            // Manejo de errores
            return redirect()->back()->with('error', 'Error al enviar la denuncia. Por favor, inténtalo de nuevo más tarde.');
        }
    }
}
