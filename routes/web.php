<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\MtMenuController;
use App\Http\Controllers\MenuPermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\SalaryHistoryController;





Route::get('/', fn () => Inertia::render('auth/sign-in/sign-in-2'));
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
Route::get('/pricing', fn () => Inertia::render('pricing/index'));

Route::group(['prefix' => '/dashboard', 'middleware' => ['auth', 'verified']], function () {
    require __DIR__.'/dashboard.php';
});

// routes menu
Route::apiResource('mt-menu', MtMenuController::class);

// routes menu permission
Route::apiResource('menu-permission', MenuPermissionController::class);
Route::get('menu-permission/user/{user_id}', [MenuPermissionController::class, 'getMenuPermissionByUser']);

// routse user
Route::apiResource('users', UserController::class);

// routes salary
Route::apiResource('salaries', SalaryController::class);

// routes salary history
Route::apiResource('salary-histories', SalaryHistoryController::class);

require __DIR__.'/auth.php';
