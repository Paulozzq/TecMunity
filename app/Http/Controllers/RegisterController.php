<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\Usuario;
use App\Mail\TestEmail;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Session;



class RegisterController extends Controller
{
    public function index()
    {
        return view('registro');
    }

    public function register(RegisterRequest $request)
    {
        // Crea el usuario con los datos validados del formulario
        $user = Usuario::create($request->validated());

        
        // Genera un token de verificación único
        $verificationToken = Str::random(60);

        // Guarda el token de verificación en la base de datos
        $user->verification_token = $verificationToken;
        $user->save();
        
        // Envía el correo electrónico de verificación
        $this->sendVerificationEmail($user);
        
        // Redirige al usuario a la vista de esperar verificación
        return view('esperaverificacion');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:10'],
            'email' => ['required', 'string', 'email', 'max:255', 'regex:/^[a-zA-Z0-9._%+-]+@tecsup\.edu\.pe$/', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function sendVerificationEmail($user)
    {
        // Genera el enlace de verificación de correo electrónico
        $verificationLink = route('verify.email', ['token' => $user->verification_token]);
        
        // Datos para el correo electrónico
        $data = [
            'message' => 'Por favor, verifica tu correo electrónico.',
            'verification_link' => $verificationLink
        ];
    
        // Envía el correo electrónico de verificación al usuario
        try {
            Mail::to($user->email)->send(new TestEmail($data));
        } catch (\Exception $e) {
            // Maneja cualquier error que ocurra al enviar el correo electrónico
            return redirect()->back()->with('error', 'Hubo un error al enviar el correo de verificación. Por favor, inténtalo de nuevo más tarde.');
        }
    }
    public function verifyEmail(Request $request)
{
    $token = $request->token;
    
    // Busca el usuario con el token de verificación
    $user = Usuario::where('verification_token', $token)->first();
    
    if ($user) {
        // Marca al usuario como verificado
        $user->email_verified_at = now();
        $user->verification_token = null;
        $user->save();
        
        // Redirige al usuario al inicio de sesión o a donde desees
        return redirect('/login')->with('success', '¡Tu correo electrónico ha sido verificado correctamente!');
    } else {
        // Si no se encuentra ningún usuario con ese token, muestra un mensaje de error
        return redirect('/')->with('error', 'El token de verificación es inválido.');
    }
}
}


