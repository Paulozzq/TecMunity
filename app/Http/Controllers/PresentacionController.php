<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrera;
use Illuminate\Support\Facades\Auth;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class PresentacionController extends Controller
{
    public function index()
    {
        $carreras = Carrera::all();
        return view('Tecmunity.presentacion', compact('carreras'));
    }
}
