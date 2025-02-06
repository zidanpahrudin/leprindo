<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', fn () => Inertia::render('dashboard/index'))->name('dashboard');

Route::group(['prefix' => '/settings'], function () {
  Route::get('/', fn () => Inertia::render('settings/profile/index'))->name('dashboard.contacts');
  Route::get('/account', fn () => Inertia::render('settings/account/index'))->name('dashboard.contacts');
  Route::get('/appearance', fn () => Inertia::render('settings/appearance/index'))->name('dashboard.file-manager');
  Route::get('/display', fn () => Inertia::render('settings/display/index'))->name('dashboard.notes');
  Route::get('/notifications', fn () => Inertia::render('settings/notifications/index'))->name('dashboard.scrumboard');
  Route::get('/profile', fn () => Inertia::render('settings/profile/index'))->name('dashboard.todo');
});

Route::get('/apps', fn () => Inertia::render('apps/index'))->name('dashboard.apps');
Route::get('/chats', fn () => Inertia::render('chats/index'))->name('dashboard.chats');
Route::get('/charts', fn () => Inertia::render('charts/index'))->name('dashboard.charts');
Route::get('/tasks', fn () => Inertia::render('tasks/index'))->name('dashboard.tasks');
Route::get('/users', fn () => Inertia::render('users/index'))->name('dashboard.users');
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
Route::get('/help-center', fn () => Inertia::render('coming-soon/index'))->name('dashboard.coming-soon');
