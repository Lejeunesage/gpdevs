<?php

use App\Http\Controllers\ColonneController;
use App\Http\Controllers\EquipeController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\MembreEquipeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TacheController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [HomeController::class, 'home'])->name('home');


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Equipe
Route::get('/equipe/create', [EquipeController::class, 'create'])->name('equipe.create')->middleware('auth');
Route::post('/equipe/store', [EquipeController::class, 'store'])->name('equipe.store')->middleware('auth');
Route::post('/equipe/ajoutMembre', [EquipeController::class, 'ajoutMembre'])->name('equipe.ajoutMembre')->middleware('auth');

// MembreEquipe
Route::post('/search-members', [MembreEquipeController::class, 'searchMembers'])->name('search.members');
Route::post('/select-members', [MembreEquipeController::class, 'selectMember'])->name('select.members');

// Espace de travail
Route::get('/workplace/index', [EquipeController::class, 'index'])->name('workplace.index')->middleware('auth');

// Kanban
Route::get('/kanban', [TacheController::class, 'index'])->name('kanban.index')->middleware('auth');
Route::post('/column/store', [ColonneController::class, 'store'])->name('column.store')->middleware('auth');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
