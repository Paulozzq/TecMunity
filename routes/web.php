<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ModalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\DashboardController;


Route::get('/', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
Route::get('/espera', function () {
    return view('esperaverificacion');
})->name('espera');

Route::get('/verify-email/{token}', [RegisterController::class, 'verifyEmail'])->name('verify.email');

Route::middleware(['auth', 'verified'])->get('/account', [HomeController::class, 'account'])->name('account');
Route::middleware(['auth', 'verified'])->get('/informacion-Personal', [ProfileController::class, 'edit'])->name('infoPersonal');
Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');


Route::middleware(['auth', 'verified'])->get('/publicaciones', [PublicacionController::class, 'index'])->name('publicaciones.index');
Route::middleware(['auth', 'verified'])->post('/publicaciones', [PublicacionController::class, 'store'])->name('publicaciones.store');

Route::get('perfil/{id}', [PerfilController::class, 'show'])->name('perfil.show');

Route::middleware(['auth', 'verified'])->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');


Route::get('/publicaciones', [PublicacionController::class, 'index'])->name('publicaciones.index');
Route::post('/publicaciones', [PublicacionController::class, 'store'])->name('publicaciones.store');
Route::post('/publicaciones/{publicacion}', [PublicacionController::class, 'update'])->name('publicaciones.update');
Route::delete('/publicaciones/{publicacion}', [PublicacionController::class, 'destroy'])->name('publicaciones.destroy');

Route::get('/publicaciones', [PublicacionController::class, 'index'])->name('publicaciones.index');
Route::post('/publicaciones', [PublicacionController::class, 'store'])->name('publicaciones.store');
?>