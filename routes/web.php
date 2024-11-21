<?php

use App\Http\Controllers\AlunoController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [DashBoardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->prefix('cursos')->name('cursos.')->group(function () {
    Route::get('/', [CursoController::class, 'index'])->name('index');
    Route::get('/create', [CursoController::class, 'create'])->name('create');
    Route::post('/', [CursoController::class, 'store'])->name('store');
    Route::post('/destroyAll', [CursoController::class, 'destroyAll'])->name('destroyAll');
    Route::get('/{curso}/edit', [CursoController::class, 'edit'])->name('edit');
    Route::put('/{curso}', [CursoController::class, 'update'])->name('update');
    Route::delete('/{curso}', [CursoController::class, 'destroy'])->name('destroy');
    Route::post('/{curso}/matricular/{aluno}', [CursoController::class, 'matricular'])->name('cursos.matricular');
    Route::delete('/{curso}/desmatricular/{aluno}', [CursoController::class, 'desmatricular'])->name('cursos.desmatricular');
    Route::get('/{curso}/alunos', [CursoController::class, 'alunos'])->name('alunos');
});

Route::middleware('auth')->prefix('alunos')->name('alunos.')->group(function () {
    Route::get('/', [AlunoController::class, 'index'])->name('index');
    Route::get('/create', [AlunoController::class, 'create'])->name('create');
    Route::post('/', [AlunoController::class, 'store'])->name('store');
    Route::post('/destroyAll', [AlunoController::class, 'destroyAll'])->name('destroyAll');
    Route::get('/{curso}/edit', [AlunoController::class, 'edit'])->name('edit');
    Route::put('/{curso}', [AlunoController::class, 'update'])->name('update');
    Route::delete('/{curso}', [AlunoController::class, 'destroy'])->name('destroy');
});



require __DIR__ . '/auth.php';
