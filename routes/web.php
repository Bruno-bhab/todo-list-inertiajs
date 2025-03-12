<?php

use App\Http\Controllers\LinkController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    if(app()->environment('local')){
        auth()->loginUsingId(1);
        return redirect(route('dashboard'));
    }

    return Inertia::render('Welcome');
})->name('home');

Route::get('/link/{link_name}', [LinkController::class, 'loadLinkPage'])->name('link');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/todo', [TodoController::class, 'index'])->name('todo.index');
    Route::post('/todo', [TodoController::class, 'store'])->name('todo.store');
    Route::put('/todo/{todo}', [TodoController::class, 'update'])->name('todo.update');
    Route::delete('/todo/{todo}', [TodoController::class, 'destroy'])->name('todo.destroy');

    Route::get('/link', [LinkController::class, 'index'])->name('link.index');
    Route::get('/link/edit/{link}', [LinkController::class,'edit'])->name('link.edit');
    Route::delete('/link/{link}', [LinkController::class, 'destroy'])->name('link.destroy');
});



require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
