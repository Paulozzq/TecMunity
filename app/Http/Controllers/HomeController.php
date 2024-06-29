<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario; // Asegúrate de importar el modelo Usuario aquí

class HomeController extends Controller
{
    public function index(){
        $usuarios = Usuario::with('roles')->get(); // Carga la relación 'roles'
        return view('main', compact('usuarios'));
    }

    public function account(){
        return view('Tecmunity.account');
    }
}