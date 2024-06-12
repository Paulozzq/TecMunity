<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    RegisterController,
    LoginController,
    LogoutController,
    HomeController,
    ProfileController,
    PublicacionController,
    PerfilController,
    DashboardController,
    ComentarioController,
    LikeController,
    PresentacionController,
    AmistadController
};

// Rutas de autenticación y registro
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::get('/', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

// Verificación de email
Route::get('/espera', function () {
    return view('esperaverificacion');
})->name('espera');
Route::get('/verify-email/{token}', [RegisterController::class, 'verifyEmail'])->name('verify.email');

// Rutas protegidas por middleware auth y verified
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/account', [HomeController::class, 'account'])->name('account');
    Route::get('/informacion-Personal', [ProfileController::class, 'edit'])->name('infoPersonal');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    Route::get('/publicaciones', [PublicacionController::class, 'index'])->name('publicaciones.index');
    Route::post('/publicaciones', [PublicacionController::class, 'store'])->name('publicaciones.store');
    Route::post('/publicaciones/{publicacion}', [PublicacionController::class, 'update'])->name('publicaciones.update');
    Route::delete('/publicaciones/{publicacion}', [PublicacionController::class, 'destroy'])->name('publicaciones.destroy');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/publicacion/{id}', [ComentarioController::class, 'show'])->name('comentario.show');
    Route::post('/comentarios', [ComentarioController::class, 'store'])->name('comentarios.store');
    Route::post('/publicacion/{publicacion}/like', [LikeController::class, 'likePublicacion'])->name('like.publicacion');
    Route::post('/publicacion/{publicacion}/unlike', [LikeController::class, 'unlikePublicacion'])->name('unlike.publicacion');
    Route::post('/comentario/{comentario}/like', [LikeController::class, 'likeComentario'])->name('like.comentario');
    Route::post('/comentario/{comentario}/unlike', [LikeController::class, 'unlikeComentario'])->name('unlike.comentario');
    Route::post('/comentarios/responder', [ComentarioController::class, 'reply'])->name('comentario.reply');

    Route::get('/usuarios', [DashboardController::class, 'index_list'])->name('usuarios.index');
    Route::get('/usuarios/{id}', [DashboardController::class, 'show'])->name('usuarios.show');
    Route::get('/usuarios/edit/{id}', [DashboardController::class, 'edit'])->name('usuarios.edit');
    Route::put('/usuarios/{id}', [DashboardController::class, 'update'])->name('usuarios.update');
    Route::delete('/usuarios/{id}', [DashboardController::class, 'destroy'])->name('usuarios.destroy');
    Route::get('/presentacion', [PresentacionController::class, 'index'])->name('presentacion.index');

    // Ruta para procesar el formulario de presentación
    Route::post('/presentacion', [PresentacionController::class, 'store'])->name('presentacion.store');
    Route::post('/amistad/{id}', [AmistadController::class, 'seguir'])->name('perfil.seguir');
    Route::post('/seguirDeVuelta/{id}', [AmistadController::class, 'SeguirDeVuelta'])->name('perfil.seguirOtra');
    Route::post('/dejar-de-seguir/{id}', [AmistadController::class, 'dejarDeSeguir'])->name('perfil.dejar-de-seguir');
});

// Ruta de perfil de usuario
Route::get('perfil/{id}', [PerfilController::class, 'show'])->name('perfil.show');

