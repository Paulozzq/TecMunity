<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class PasswordController extends Controller
{
    public function index()
    {
        return view('contraseña');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'email' => 'required|string|email',
        ]);

        // Ajusta 'username' a la columna correcta si es necesario
        $user = Usuario::where('username', $request->username)
                    ->where('email', $request->email)
                    ->first();

        if ($user) {
            $newPassword = Str::random(8);
            $user->password = Hash::make($newPassword);
            $user->save();

            Mail::send('emails.Passowrd_Reset', ['usuario' => $user, 'newPassword' => $newPassword], function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Tu nueva contraseña');
            });

            return back()->with('status', 'Se ha enviado una nueva contraseña a tu correo electrónico.');
        } else {
            return back()->withErrors(['email' => 'Las credenciales no coinciden con nuestros registros.']);
        }
    }
}

