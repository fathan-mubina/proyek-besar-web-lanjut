<?php


use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\KomentarProjectController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PengingatController;
use App\Http\Controllers\LampiranController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.index');
});



Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->middleware('guest');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/tugas', [TugasController::class, 'index'])->name('tugas.index');
    Route::get('/tugas/create', [TugasController::class, 'create'])->name('tugas.create');
    Route::post('/tugas', [TugasController::class, 'store'])->name('tugas.store');
    Route::get('/tugas/{id}/edit', [TugasController::class, 'edit'])->name('tugas.edit');
    Route::put('/tugas/{id}', [TugasController::class, 'update'])->name('tugas.update');
    Route::delete('/tugas/{id}', [TugasController::class, 'destroy'])->name('tugas.destroy');
});


Route::middleware('auth')->group(function () {
    Route::get('/proyek', [ProjectController::class, 'index'])->name('proyek.index');
    Route::get('/proyek/create', [ProjectController::class, 'create'])->name('proyek.create');
    Route::post('/proyek', [ProjectController::class, 'store'])->name('proyek.store');
    Route::get('/proyek/{id}', [ProjectController::class, 'show'])->name('proyek.detail');
    Route::post('/proyek/{id}/anggota',[ProjectController::class,'addMember'])->name('proyek.addMember');
    Route::post('/proyek/{project}/komentar',[KomentarProjectController::class, 'store'])->name('proyek.komentar.store');
    Route::delete('/proyek/{project}/anggota/{user}',
    [ProjectController::class, 'removeMember']
)->name('proyek.removeMember');
});

Route::delete('/komentar/{id}', [KomentarProjectController::class, 'destroy'])->name('komentar.destroy');


Route::middleware('auth')->group(function () {
    Route::resource('kategori', CategoryController::class);
});


Route::middleware('auth')->group(function () {
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
});


Route::middleware('auth')->group(function () {
    Route::get('/pengingat', [PengingatController::class, 'index'])->name('pengingat.index');
});


Route::middleware('auth')->group(function () {
    Route::get('/lampiran', [LampiranController::class, 'index'])->name('lampiran.index');
});


Route::middleware('auth')->group(function () {
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil.index');
    Route::get('/profil/edit', [ProfilController::class, 'edit'])->name('profil.edit');
   Route::put('/profil/update', [ProfilController::class, 'update'])->name('profil.update');
});


require __DIR__.'/auth.php';
