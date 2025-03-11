<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    if(app()->environment('local')){
        Auth::loginUsingId(1);
        return redirect()->route('dashboard');
    }

    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/todo', [TodoController::class, 'index'])->name('todo');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
