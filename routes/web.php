<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SMAController;
// ======================
// ROUTE LOGIN
// ======================
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// ======================
// ROUTE DASHBOARD (Hanya bisa diakses jika sudah login)
// ======================
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

// ======================
// ROUTE LAIN
// ======================
Route::get('/sma', fn() => view('sma'));

Route::get('/smk', fn() => view('smk'));
Route::get('/slb', fn() => view('slb'));

Route::get('/gtkSMA', [SMAController::class, 'gtkSMA']);
Route::get('/gtkSMK', [SMAController::class, 'gtkSMK']);
Route::get('/gtkSLB', [SMAController::class, 'gtkSLB']);

Route::get('/drmSMA', [SMAController::class, 'drmSMA']);
Route::get('/drmSMK', [SMAController::class, 'drmSMK']);
Route::get('/drmSLB', [SMAController::class, 'drmSLB']);

Route::get('/disSMA', [SMAController::class, 'disSMA']);
Route::get('/disSMK', [SMAController::class, 'disSMK']);
Route::get('/disSLB', [SMAController::class, 'disSLB']);

Route::get('/dasarSMA', [SMAController::class, 'sarprasSMA']);
Route::get('/dasarSMK', [SMAController::class, 'sarprasSMK']);
Route::get('/dasarSLB', [SMAController::class, 'sarprasSLB']);
