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
    AmistadController,
    GrupoController,
    PasswordResetController,
    NotificacionesController, 
    MensajeriaController,
    DenunciaController,
    PublicacionGrupoController,
    LikeGrupoController,
    ComentarioGrupoController,
    NoticiaController,
    BuscadorController,
    PasswordController,
};

// Rutas de autenticación y registro
Route::get('/registro', [RegisterController::class, 'index'])->name('registro');
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('loginpost');
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
Route::get('password/reset-request', [PasswordController::class, 'index'])->name('password.request');
Route::post('password/email', [PasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Verificación de email
Route::get('/espera', function () {
    return view('esperaverificacion');
})->name('espera');
Route::get('/verify-email/{token}', [RegisterController::class, 'verifyEmail'])->name('verify.email');

// Rutas protegidas por middleware auth y verified
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/account', [HomeController::class, 'account'])->name('account');
   
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/publicaciones', [PublicacionController::class, 'index'])->name('publicaciones.index');
    Route::post('/publicaciones', [PublicacionController::class, 'store'])->name('publicaciones.store');
    Route::post('/publicaciones/{publicacion}', [PublicacionController::class, 'update'])->name('publicaciones.update');
    Route::delete('/publicaciones/{publicacion}', [PublicacionController::class, 'destroy'])->name('publicaciones.destroy');
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/publicacion/{id}', [ComentarioController::class, 'show'])->name('comentario.show');
    Route::post('/comentarios', [ComentarioController::class, 'store'])->name('comentarios.store');
    Route::get('/comentario/{id}', [ComentarioController::class, 'showReply'])->name('comentario.showReply');
    Route::post('/reply', [ComentarioController::class, 'reply'])->name('comentarios.reply');
    Route::post('/denuncias', [DenunciaController::class, 'store'])->name('denuncias.store');

    Route::post('/publicacion/{publicacion}/like', [LikeController::class, 'likePublicacion'])->name('like.publicacion');
    Route::post('/publicacion/{publicacion}/unlike', [LikeController::class, 'unlikePublicacion'])->name('unlike.publicacion');
    Route::post('/comentario/{comentario}/like', [LikeController::class, 'likeComentario'])->name('like.comentario');
    Route::post('/comentario/{comentario}/unlike', [LikeController::class, 'unlikeComentario'])->name('unlike.comentario');

    Route::get('/notificaciones', [NotificacionesController::class, 'show'])->name('notificaciones.index');
    Route::get('/mensajes', [MensajeriaController::class, 'show'])->name('mensajeria.index');

    Route::get('/usuarios', [DashboardController::class, 'index_list'])->name('usuarios.index');
    Route::get('/usuarios/{id}', [DashboardController::class, 'show'])->name('usuarios.show');
    Route::get('/usuarios/edit/{id}', [DashboardController::class, 'edit'])->name('usuarios.edit');
    Route::put('/usuarios/{id}', [DashboardController::class, 'update'])->name('usuarios.update');
    Route::delete('/usuarios/{id}', [DashboardController::class, 'destroy'])->name('usuarios.destroy');

    // Denuncias
    Route::prefix('dashboard')->group(function () {
        Route::get('/denuncias', [DashboardController::class, 'index_tick'])->name('dashboard.denuncias.index');
        Route::get('/denuncias/{denuncia}', [DashboardController::class, 'show_tick'])->name('dashboard.denuncias.show');
        Route::delete('/denuncias/{denuncia}', [DashboardController::class, 'destroy_tick'])->name('dashboard.denuncias.destroy');
        Route::patch('/denuncias/{denuncia}/aprobado', [DashboardController::class, 'aprobado_tick'])->name('dashboard.denuncias.aprobado');
        Route::patch('/denuncias/{denuncia}/desaprobado', [DashboardController::class, 'desaprobado_tick'])->name('dashboard.denuncias.desaprobado');
    });

    Route::get('/presentacion', [PresentacionController::class, 'index'])->name('presentacion.index');
    Route::post('/presentacion', [PresentacionController::class, 'store'])->name('presentacion.store');
    Route::get('/busqueda', [BuscadorController::class, 'index'])->name('buscar.index');
    Route::post('/amistad/{id}', [AmistadController::class, 'seguir'])->name('perfil.seguir');
    Route::post('/seguir-de-vuelta/{id}', [AmistadController::class, 'SeguirDeVuelta'])->name('perfil.seguirOtra');
    Route::post('/dejar-de-seguir/{id}', [AmistadController::class, 'dejarDeSeguir'])->name('perfil.dejar-de-seguir');
    Route::get('/check-friendship-status/{id}', [AmistadController::class, 'checkFriendshipStatus'])->name('perfil.checkFriendshipStatus');

    Route::get('/grupos/create', [GrupoController::class, 'create'])->name('grupos.create');
    Route::post('/grupos', [GrupoController::class, 'store'])->name('grupos.store');
    Route::post('/grupos/join', [GrupoController::class, 'join'])->name('grupos.join'); // Acción de unirse a un grupo
    Route::get('/grupos/{id}', [GrupoController::class, 'index'])->name('grupos.index');
    Route::post('/grupos/{id}/guardar-info-grupo', [GrupoController::class, 'guardarInfoGrupo'])
    ->name('grupos.guardarInfoGrupo');


    Route::get('/perfil/{id}', [PerfilController::class, 'show'])->name('perfil.show');
    Route::prefix('grupos')->group(function () {
        Route::get('{grupo}/publicaciones', [PublicacionGrupoController::class, 'index'])
             ->name('grupos.publicaciones.index');

        Route::post('{grupo}/publicaciones', [PublicacionGrupoController::class, 'store'])
             ->name('grupos.publicaciones.store');

        Route::put('{grupo}/publicaciones/{publicacion}', [PublicacionGrupoController::class, 'update'])
             ->name('grupos.publicaciones.update');

        Route::delete('{grupo}/publicaciones/{publicacion}', [PublicacionGrupoController::class, 'destroy'])
             ->name('grupos.publicaciones.destroy');

    });

    Route::post('/grupo/publicaciones/{publicacionId}/like', [LikeGrupoController::class, 'likePublicacion'])->name('grupo.publicaciones.like');
    Route::post('/grupo/publicaciones/{publicacionId}/unlike', [LikeGrupoController::class, 'unlikePublicacion'])->name('grupo.publicaciones.unlike');
    
    Route::post('/grupo/comentarios/{comentarioId}/like', [LikeGrupoController::class, 'likeComentario'])->name('grupo.comentarios.like');
    Route::post('/grupo/comentarios/{comentarioId}/unlike', [LikeGrupoController::class, 'unlikeComentario'])->name('grupo.comentarios.unlike');
    Route::post('/comentarios/grupo/store', [ComentarioGrupoController::class, 'store'])->name('comentarios.grupo.store');
    Route::post('/comentarios/grupo/reply', [ComentarioGrupoController::class, 'reply'])->name('comentarios.grupo.reply');
    Route::get('/comentarios/grupo/{id}', [ComentarioGrupoController::class, 'show'])->name('comentarios.grupo.show');
    Route::get('/comentarios/grupo/{id}/replies', [ComentarioGrupoController::class, 'showReply'])->name('comentarios.grupo.showReply');
    
});



