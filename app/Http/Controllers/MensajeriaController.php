<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario; // Assuming Usuario is your model for users/friends
use Illuminate\Support\Facades\Auth;

class MensajeriaController extends Controller
{
    public function show(){
        $amigos = Auth::user()->amigos; // Assuming amigos is a relationship in your User model

        return view('Tecmunity.mensajeria', compact('amigos'));
    }
}
