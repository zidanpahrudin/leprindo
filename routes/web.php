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

Route::get('/apps', fn () => Inertia::render('apps/index'))->middleware(['auth', 'verified']);
Route::get('/chats', fn () => Inertia::render('chats/index'))->middleware(['auth', 'verified']);
Route::get('/tasks', fn () => Inertia::render('tasks/index'))->middleware(['auth', 'verified']);
Route::get('/users', fn () => Inertia::render('users/index'))->middleware(['auth', 'verified']);
Route::get('/sign-in', fn () => Inertia::render('auth/sign-in/index'));
Route::get('/sign-in-2', fn () => Inertia::render('auth/sign-in/sign-in-2'));
Route::get('/sign-up', fn () => Inertia::render('auth/sign-up/index'));
Route::get('/forgot-pass', fn () => Inertia::render('auth/forgot-password/index'));
Route::get('/otp', fn () => Inertia::render('auth/otp/index'));
Route::get('/401', fn () => Inertia::render('errors/unauthorized-error'));
Route::get('/403', fn () => Inertia::render('errors/forbidden'));
Route::get('/404', fn () => Inertia::render('errors/not-found-error'));
Route::get('/500', fn () => Inertia::render('errors/general-error'));
Route::get('/503', fn () => Inertia::render('errors/maintenance-error'));
Route::get('/help-center', fn () => Inertia::render('coming-soon/index'));

Route::group(['prefix' => '/settings'], function () {
    Route::get('/', fn () => Inertia::render('settings/profile/index'))->name('app.contacts');
    Route::get('/account', fn () => Inertia::render('settings/account/index'))->name('app.contacts');
    Route::get('/appearance', fn () => Inertia::render('settings/appearance/index'))->name('app.file-manager');
    Route::get('/display', fn () => Inertia::render('settings/display/index'))->name('app.notes');
    Route::get('/notifications', fn () => Inertia::render('settings/notifications/index'))->name('app.scrumboard');
    Route::get('/profile', fn () => Inertia::render('settings/profile/index'))->name('app.todo');
})->middleware(['auth', 'verified']);

Route::middleware('/auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
})->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
