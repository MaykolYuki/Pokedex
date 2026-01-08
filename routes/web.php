<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/register', [App\Http\Controllers\FormController::class, 'showForm'])->name('register');
Route::post('/register', [App\Http\Controllers\FormController::class, 'store'])->name('register.store');

Route::get('/registerRegion', [App\Http\Controllers\FormRegionControler::class, 'showForm'])->name('registerRegion');
Route::post('/registerRegion', [App\Http\Controllers\FormRegionControler::class, 'store'])->name('registerRegion.store');

Route::get('/pokedex/show/{id_pokemon}', [App\Http\Controllers\ShowController::class, 'store'])->name('showPokemon.store');

Route::get('/pokedex/update/{id_pokemon}', [App\Http\Controllers\UpdatePokemonController::class, 'showForm'])->name('update');
Route::put('/pokedex/update/{id_pokemon}', [App\Http\Controllers\UpdatePokemonController::class, 'store'])->name('update.store');

Route::delete('/pokedex/delete/{id_pokemon}', [App\Http\Controllers\DeletePokemonController::class, 'deletePokemon'])->name('delete');