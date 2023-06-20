<?php

use App\Http\Controllers\ColonneController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProjetController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\MembreProjetController;
use App\Http\Controllers\MessageController;
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

// Dashboard
Route::get('/dashboard', [ProjetController::class, 'index'])->name('dashboard')->middleware(['auth', 'verified']);

// Layout
Route::get('/layout/index', [Controller::class, 'index'])->name('layout.index')->middleware('auth');

// Projet
Route::get('/projet/create', [ProjetController::class, 'create'])->name('projet.create')->middleware('auth');
Route::post('/projet/store', [ProjetController::class, 'store'])->name('projet.store')->middleware('auth');
Route::get('/projet/show/{id}', [ProjetController::class, 'show'])->name('projet.show')->middleware('auth');
Route::post('/projet/destroy', [ProjetController::class, 'destroy'])->name('projet.destroy')->middleware('auth');


// MembreProjet
Route::post('/membre/store', [MembreProjetController::class, 'store'])->name('membre.store')->middleware('auth');
Route::post('/membre/delete', [MembreProjetController::class, 'destroy'])->name('membre.delete')->middleware('auth');
Route::post('/search-members', [MembreProjetController::class, 'searchMembers'])->name('search.members');
Route::post('/select-members', [MembreProjetController::class, 'selectMember'])->name('select.members');

// Espace de travail
Route::get('/workplace/index', [ProjetController::class, 'index'])->name('workplace.index')->middleware('auth');

// Kanban
Route::get('/kanban', [TacheController::class, 'index'])->name('kanban.index')->middleware('auth');

// Colonne
Route::post('/column/store', [ColonneController::class, 'store'])->name('column.store')->middleware('auth');
Route::post('/column/update', [ColonneController::class, 'update'])->name('column.update')->middleware('auth');
Route::post('/column/destroy', [ColonneController::class, 'destroy'])->name('column.destroy')->middleware('auth');

// Tâche
Route::post('/tache/store', [TacheController::class, 'store'])->name('tache.store')->middleware('auth');
Route::post('/tache/destroy', [TacheController::class, 'destroy'])->name('tache.destroy')->middleware('auth');
Route::post('/tache/colonneUpdate', [TacheController::class, 'colonneUpdate'])->name('tache.colonneUpdate')->middleware('auth');


// Message
Route::post('/message/index', [MessageController::class, 'getMessages'])->name('message.index')->middleware('auth');
Route::post('/message/store', [MessageController::class, 'store'])->name('message.store')->middleware('auth');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
