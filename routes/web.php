<?php

use App\Http\Controllers\LoanController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/welcome', function(){
    return view('/welcome');
});

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware(['auth']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog');
    Route::get('/catalog/show/{id?}', [CatalogController::class, 'show'])->name('catalog.show');
    Route::get('/catalog/create', [CatalogController::class, 'create'])->name('catalog.create');
    Route::post('/catalog/create', [CatalogController::class, 'store']);
    Route::get('/catalog/edit/{id?}', [CatalogController::class, 'edit'])->name('catalog.edit');
    Route::put('/catalog/edit/{id?}', [CatalogController::class, 'update']);
    Route::put('/catalog/return/{id?}', [CatalogController::class, 'return']);
    Route::put('/catalog/rent/{id?}', [CatalogController::class, 'rent']);
    Route::delete('/catalog/delete/{id?}', [CatalogController::class, 'destroy']);
});

/*Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog');
Route::get('/catalog/show/{id?}', [CatalogController::class, 'show'])->name('catalog.show');
Route::get('/catalog/create', [CatalogController::class, 'create'])->name('catalog.create');
Route::post('/catalog/create', [CatalogController::class, 'store']);
Route::get('/catalog/edit/{id?}', [CatalogController::class, 'edit']);
Route::put('/catalog/edit/{id?}', [CatalogController::class, 'update']);*/

require __DIR__.'/auth.php';
