<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\adminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// })->name('welcome');

Route::get('/', [adminController::class, 'showDashboard'])->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/dashboard', [BeritaController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/berita/create', [BeritaController::class, 'create'])->name('admin.berita.create');
    Route::post('/admin/berita', [BeritaController::class, 'store'])->name('admin.berita.store');
    Route::get('/admin/berita/{berita}/edit', [BeritaController::class, 'edit'])->name('admin.berita.edit');
    Route::patch('/admin/berita/{berita}', [BeritaController::class, 'update'])->name('admin.berita.update');
    Route::delete('/admin/berita/{berita}', [BeritaController::class, 'destroy'])->name('admin.berita.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
