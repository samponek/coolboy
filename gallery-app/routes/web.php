<?php

use App\Http\Controllers\PhotoController;
use Illuminate\Support\Facades\Route;

// Tato řádka automaticky vytvoří všechny potřebné cesty pro 'photos' (index, create, store, show, edit, update, destroy)
Route::resource('photos', PhotoController::class);

// Pokud chceš, můžeš přidat vlastní definici pro root (kořenovou stránku)
Route::get('/', [PhotoController::class, 'index'])->name('home');