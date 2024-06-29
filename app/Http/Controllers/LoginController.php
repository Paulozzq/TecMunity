<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;

class LoginController extends Controller
{
    public function index()
    {  
        if (Auth::check()) {
            return redirect()->route('publicaciones.index');
        } else {
            return view('login');
        }
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->getCredentials();

        $remember = $request->filled('remember');

        if (!Auth::attempt($credentials, $remember)) {
            return redirect()->back()->with('login_error', 'Credenciales incorrectas. Por favor, intenta nuevamente.');
        }

        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        Auth::login($user, $remember);
        return $this->authenticated($request, $user);
    }
    

    public function authenticated(Request $request, $user)
    {
        
        $records = auth::user();
      
        
        $isComplete = true;

        
        foreach ($records as $record) {
           
            // Verifica si los campos 'nombre' y 'apellido' están vacíos
            if (empty($record->nombre) || empty($record->apellido)) {
                $isComplete = false;
                break; // Rompe el bucle si se encuentra un campo vacío
            }
        }
        

        if (empty($user->nombre) || empty($user->apellido)) {
            return redirect()->route('presentacion.index'); // Ruta si alguno de los campos está vacío
        } else {
            return redirect()->route('publicaciones.index'); // Ruta si los campos específicos están llenos
        }
    }
}
