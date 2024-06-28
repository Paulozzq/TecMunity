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
};

// Rutas de autenticación y registro
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::get('/registro',[RegisterController::class, 'index'])->name('registro');
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('loginpost');
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
    Route::get('/comentario/{id}', [ComentarioController::class, 'showReply'])->name('comentario.showReply');
    Route::post('/reply', [ComentarioController::class, 'reply'])->name('comentarios.reply');
    Route::post('/comentarios', [ComentarioController::class, 'store'])->name('comentarios.store');
    Route::post('/publicacion/{publicacion}/like', [LikeController::class, 'likePublicacion'])->name('like.publicacion');
    Route::post('/publicacion/{publicacion}/unlike', [LikeController::class, 'unlikePublicacion'])->name('unlike.publicacion');
    Route::post('/comentario/{comentario}/like', [LikeController::class, 'likeComentario'])->name('like.comentario');
    Route::post('/comentario/{comentario}/unlike', [LikeController::class, 'unlikeComentario'])->name('unlike.comentario');
    Route::post('publicacion/grupo/{publicacion}/like', [LikeGrupoController::class, 'likePublicacionGrupo'])->name('grupos.publicacion.like');
    Route::delete('publicacion/grupo/{publicacion}/unlike', [LikeGrupoController::class, 'unlikePublicacionGrupo'])->name('grupos.publicacion.unlike');
    Route::post('comentario/grupo/{comentario}/like', [LikeGrupoController::class, 'likeComentarioGrupo'])->name('grupos.comentario.like');
    Route::delete('comentario/grupo/{comentario}/unlike', [LikeGrupoController::class, 'unlikeComentarioGrupo'])->name('grupos.comentario.unlike');
    Route::post('/comentarios/responder', [ComentarioController::class, 'reply'])->name('comentario.reply');
    Route::get('/notificaciones',[NotificacionesController::class,'show'])->name('notificaciones.index');
    Route::get('/mensajes',[MensajeriaController::class,'show'])->name('mensajeria.index');
   
    Route::get('/usuarios', [DashboardController::class, 'index_list'])->name('usuarios.index');
    Route::get('/usuarios/{id}', [DashboardController::class, 'show'])->name('usuarios.show');
    Route::get('/usuarios/edit/{id}', [DashboardController::class, 'edit'])->name('usuarios.edit');
    Route::put('/usuarios/{id}', [DashboardController::class, 'update'])->name('usuarios.update');
    Route::delete('/usuarios/{id}', [DashboardController::class, 'destroy'])->name('usuarios.destroy');
    //Denuncias
    Route::get('/dashboard/denuncias', [DashboardController::class, 'index_tick'])->name('dashboard.denuncias.index');
    Route::get('/dashboard/denuncias/{denuncia}', [DashboardController::class, 'show_tick'])->name('dashboard.denuncias.show');
    Route::delete('/dashboard/denuncias/{denuncia}', [DashboardController::class, 'destroy_tick'])->name('dashboard.denuncias.destroy');
    Route::patch('/dashboard/denuncias/{denuncia}/aprobado', [DashboardController::class, 'aprobado_tick'])->name('dashboard.denuncias.aprobado');
    Route::patch('/dashboard/denuncias/{denuncia}/desaprobado', [DashboardController::class, 'desaprobado_tick'])->name('dashboard.denuncias.desaprobado');
    //
    Route::get('/presentacion', [PresentacionController::class, 'index'])->name('presentacion.index');

    // Ruta para procesar el formulario de presentación
    Route::post('/presentacion', [PresentacionController::class, 'store'])->name('presentacion.store');
    Route::post('/amistad/{id}', [AmistadController::class, 'seguir'])->name('perfil.seguir');
    Route::post('/seguirDeVuelta/{id}', [AmistadController::class, 'SeguirDeVuelta'])->name('perfil.seguirOtra');
    Route::post('/dejar-de-seguir/{id}', [AmistadController::class, 'dejarDeSeguir'])->name('perfil.dejar-de-seguir');
    Route::get('/check-friendship-status/{id}', [AmistadController::class, 'checkFriendshipStatus'])->name('perfil.checkFriendshipStatus');


    Route::get('/grupos/create', [GrupoController::class, 'create'])->name('grupos.create');
    Route::post('/grupos', [GrupoController::class, 'store'])->name('grupos.store');
    Route::post('/grupos/join', [GrupoController::class, 'join'])->name('grupos.join'); // Acción de unirse a un grupo
    Route::get('/grupos/{id}', [GrupoController::class, 'index'])->name('grupos.index');
    
    Route::get('perfil/{id}', [PerfilController::class, 'show'])->name('perfil.show');
   
});


