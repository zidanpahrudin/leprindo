<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('dashboard/index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/apps', fn () => Inertia::render('apps/index'))->name('apps.index');
Route::get('/chats', fn () => Inertia::render('chats/index'))->name('chats.index');
Route::get('/tasks', fn () => Inertia::render('tasks/index'))->name('tasks.index');
Route::get('/users', fn () => Inertia::render('users/index'))->name('users.index');
Route::group(['prefix' => 'settings'], function () {
    Route::get('/account', fn () => Inertia::render('settings/index'))->name('app.contacts');
    Route::get('/appearance', fn () => Inertia::render('settings/index'))->name('app.file-manager');
    Route::get('/display', fn () => Inertia::render('settings/index'))->name('app.notes');
    Route::get('/notifications', fn () => Inertia::render('settings/index'))->name('app.scrumboard');
    Route::get('/profile', fn () => Inertia::render('settings/index'))->name('app.todo');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
