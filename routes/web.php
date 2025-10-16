<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // Import the Auth facade
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SMAController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ======================
// ROUTE LOGIN & AUTENTIKASI
// ======================
// Grup ini memastikan bahwa semua route di dalamnya (login) hanya bisa diakses oleh tamu (guest).
// Jika pengguna sudah login, mereka akan otomatis diarahkan ke '/dashboard'.
Route::middleware('guest')->group(function () {
    // Landing page ('/') sekarang langsung menampilkan halaman login.
    Route::get('/', [AuthController::class, 'showLogin'])->name('login');
    // Route '/login' juga dipertahankan untuk konsistensi.
    Route::get('/login', [AuthController::class, 'showLogin']);
    // Route untuk memproses form login. Ditambahkan name('login.post')
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});


// =====================================================================
// SEMUA ROUTE DI BAWAH INI HANYA BISA DIAKSES JIKA PENGGUNA SUDAH LOGIN
// =====================================================================
Route::middleware('auth')->group(function () {

    // --- ROUTE LOGOUT ---
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // --- ROUTE DASHBOARD ---
    // Ini perbaikan utamanya: Mengarahkan /dashboard ke SMAController@showDashboard
    // agar data total sekolah, murid, dan guru dihitung dan dikirim ke view.
    Route::get('/dashboard', [SMAController::class, 'showDashboard'])->name('dashboard');

    // --- Route Menu Utama ---
    Route::get('/sma', fn() => view('sma'));
    Route::get('/smk', fn() => view('smk'));
    Route::get('/slb', fn() => view('slb'));

    // --- Route Data Detail ---
    // GTK Routes
    Route::get('/gtkSMA', [SMAController::class, 'gtkSMA']);
    Route::get('/gtkSMA21', [SMAController::class, 'gtkSMA21']);
    Route::get('/gtkSMA22', [SMAController::class, 'gtkSMA22']);
    Route::get('/gtkSMA23', [SMAController::class, 'gtkSMA23']);
    Route::get('/gtkSMA24', [SMAController::class, 'gtkSMA24']);
    Route::get('/gtkSMA25', [SMAController::class, 'gtkSMA25']);
    Route::get('/gtkSMK', [SMAController::class, 'gtkSMK']);
    Route::get('/gtkSMK21', [SMAController::class, 'gtkSMK21']);
    Route::get('/gtkSMK22', [SMAController::class, 'gtkSMK22']);
    Route::get('/gtkSMK23', [SMAController::class, 'gtkSMK23']);
    Route::get('/gtkSMK24', [SMAController::class, 'gtkSMK24']);
    Route::get('/gtkSMK25', [SMAController::class, 'gtkSMK25']);
    Route::get('/gtkSLB', [SMAController::class, 'gtkSLB']);
    Route::get('/gtkSLB21', [SMAController::class, 'gtkSLB21']);
    Route::get('/gtkSLB22', [SMAController::class, 'gtkSLB22']);
    Route::get('/gtkSLB23', [SMAController::class, 'gtkSLB23']);
    Route::get('/gtkSLB24', [SMAController::class, 'gtkSLB24']);
    Route::get('/gtkSLB25', [SMAController::class, 'gtkSLB25']);

    // Data Rekap Murid (DRM) Routes
    Route::get('/drmSMA', [SMAController::class, 'drmSMA']);
    Route::get('/drmSMA21', [SMAController::class, 'drmSMA21']);
    Route::get('/drmSMA22', [SMAController::class, 'drmSMA22']);
    Route::get('/drmSMA23', [SMAController::class, 'drmSMA23']);
    Route::get('/drmSMA24', [SMAController::class, 'drmSMA24']);
    Route::get('/drmSMA25', [SMAController::class, 'drmSMA25']);
    Route::get('/drmSMK', [SMAController::class, 'drmSMK']);
    Route::get('/drmSMK21', [SMAController::class, 'drmSMK21']);
    Route::get('/drmSMK22', [SMAController::class, 'drmSMK22']);
    Route::get('/drmSMK23', [SMAController::class, 'drmSMK23']);
    Route::get('/drmSMK24', [SMAController::class, 'drmSMK24']);
    Route::get('/drmSMK25', [SMAController::class, 'drmSMK25']);
    Route::get('/drmSLB', [SMAController::class, 'drmSLB']);
    Route::get('/drmSLB21', [SMAController::class, 'drmSLB21']);
    Route::get('/drmSLB22', [SMAController::class, 'drmSLB22']);
    Route::get('/drmSLB23', [SMAController::class, 'drmSLB23']);
    Route::get('/drmSLB24', [SMAController::class, 'drmSLB24']);
    Route::get('/drmSLB25', [SMAController::class, 'drmSLB25']);

    // Data Identitas Sekolah (DIS) Routes
    Route::get('/disSMA', [SMAController::class, 'disSMA']);
    Route::get('/disSMA21', [SMAController::class, 'disSMA21']);
    Route::get('/disSMA22', [SMAController::class, 'disSMA22']);
    Route::get('/disSMA23', [SMAController::class, 'disSMA23']);
    Route::get('/disSMA24', [SMAController::class, 'disSMA24']);
    Route::get('/disSMA25', [SMAController::class, 'disSMA25']);
    Route::get('/disSMK', [SMAController::class, 'disSMK']);
    Route::get('/disSMK21', [SMAController::class, 'disSMK21']);
    Route::get('/disSMK22', [SMAController::class, 'disSMK22']);
    Route::get('/disSMK23', [SMAController::class, 'disSMK23']);
    Route::get('/disSMK24', [SMAController::class, 'disSMK24']);
    Route::get('/disSMK25', [SMAController::class, 'disSMK25']);
    Route::get('/disSLB', [SMAController::class, 'disSLB']);
    Route::get('/disSLB21', [SMAController::class, 'disSLB21']);
    Route::get('/disSLB22', [SMAController::class, 'disSLB22']);
    Route::get('/disSLB23', [SMAController::class, 'disSLB23']);
    Route::get('/disSLB24', [SMAController::class, 'disSLB24']);
    Route::get('/disSLB25', [SMAController::class, 'disSLB25']);

    // Data Sarana Prasarana (Sarpras) Routes
    Route::get('/dasarSMA', [SMAController::class, 'sarprasSMA']);
    Route::get('/dasarSMA21', [SMAController::class, 'sarprasSMA21']);
    Route::get('/dasarSMA22', [SMAController::class, 'sarprasSMA22']);
    Route::get('/dasarSMA23', [SMAController::class, 'sarprasSMA23']);
    Route::get('/dasarSMA24', [SMAController::class, 'sarprasSMA24']);
    Route::get('/dasarSMA25', [SMAController::class, 'sarprasSMA25']);
    Route::get('/dasarSMK', [SMAController::class, 'sarprasSMK']);
    Route::get('/dasarSMK21', [SMAController::class, 'sarprasSMK21']);
    Route::get('/dasarSMK22', [SMAController::class, 'sarprasSMK22']);
    Route::get('/dasarSMK23', [SMAController::class, 'sarprasSMK23']);
    Route::get('/dasarSMK24', [SMAController::class, 'sarprasSMK24']);
    Route::get('/dasarSMK25', [SMAController::class, 'sarprasSMK25']);
    Route::get('/dasarSLB', [SMAController::class, 'sarprasSLB']);
    Route::get('/dasarSLB21', [SMAController::class, 'sarprasSLB21']);
    Route::get('/dasarSLB22', [SMAController::class, 'sarprasSLB22']);
    Route::get('/dasarSLB23', [SMAController::class, 'sarprasSLB23']);
    Route::get('/dasarSLB24', [SMAController::class, 'sarprasSLB24']);
    Route::get('/dasarSLB25', [SMAController::class, 'sarprasSLB25']);
});

