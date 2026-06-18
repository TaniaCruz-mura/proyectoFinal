<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Admin\UserController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Todas las rutas dentro de este grupo requieren inicio de sesión
Route::middleware('auth')->group(function () {
    
    // Rutas de Perfil (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ==========================================
    // RUTAS DE LA FASE 4 (CRUD RECURSOS)
    // ==========================================
    
    // CRUD Completo de Proyectos
    Route::resource('projects', ProjectController::class);

    // CRUD Completo de Tareas
    Route::resource('tasks', TaskController::class);

    // CRUD Completo de Miembros del Equipo
    Route::resource('members', MemberController::class);

    // CRUD Completo de Comentarios
    Route::resource('comments', CommentController::class);

    // ==========================================
    // SECCIÓN DE ADMINISTRACIÓN (SOLO ADMINS)
    // ==========================================
    Route::middleware(['role:Administrador'])->prefix('admin')->name('admin.')->group(function () {
        Route::resource('users', UserController::class);
    });

});

require __DIR__.'/auth.php';