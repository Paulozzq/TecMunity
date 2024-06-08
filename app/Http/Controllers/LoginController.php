<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;

class LoginController extends Controller
{
    public function index(){  
        if (Auth::check()) {
            return redirect('/publicaciones');
        }else {
            return view('login');
        }
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->getCredentials();

        if (!Auth::attempt($credentials)) {
            return redirect('/')->withErrors(['error' => 'Credenciales incorrectas.']);
        }

        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        #if (!$user->email_verified_at) {
            #Auth::logout();
            #return redirect('/')->with('login_error', 'Debes verificar tu correo electrónico antes de iniciar sesión.');
        #}

        Auth::login($user);
        return $this->authenticated($request, $user);

    }

    public function authenticated(Request $request, $user)
    {
        if (empty($record->nombre) || empty($record->apellido))
            $records = Usuario::all();
            $isComplete = true;

            foreach ($records as $record) {
                // Verifica si los campos 'nombre' y 'apellido' están vacíos
                if (empty($record->nombre) || empty($record->apellido)) {
                    $isComplete = false;
                    break; // Rompe el bucle si se encuentra un campo vacío
                }
            }

            if ($isComplete) {
                return redirect()->route('publicaciones.index'); // Ruta si los campos específicos están llenos
            } else {
                return redirect()->route('presentacion.index'); // Ruta si alguno de los campos está vacío
            }
    }
    
}