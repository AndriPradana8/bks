<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ui', function () {
    return view('ui');
});

Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user->role === 'superadmin') return redirect()->route('superadmin.dashboard');
    if ($user->role === 'admin') return redirect()->route('admin.dashboard');
    if ($user->role === 'nasabah') return redirect()->route('nasabah.dashboard');
    return abort(403);
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::get('/superadmin/dashboard', function () {
        return view('superadmin.dashboard');
    })->name('superadmin.dashboard');

    Route::get('/superadmin/data-nasabah', [App\Http\Controllers\NasabahController::class, 'index'])->name('superadmin.nasabah');
    Route::post('/superadmin/data-nasabah', [App\Http\Controllers\NasabahController::class, 'store'])->name('superadmin.nasabah.store');
    Route::put('/superadmin/data-nasabah/{nasabah}', [App\Http\Controllers\NasabahController::class, 'update'])->name('superadmin.nasabah.update');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/admin/data-nasabah', [App\Http\Controllers\NasabahController::class, 'index'])->name('admin.nasabah');
    Route::post('/admin/data-nasabah', [App\Http\Controllers\NasabahController::class, 'store'])->name('admin.nasabah.store');
    Route::put('/admin/data-nasabah/{nasabah}', [App\Http\Controllers\NasabahController::class, 'update'])->name('admin.nasabah.update');

    Route::get('/admin/tabungan', function () {
        return view('admin.tabungan');
    })->name('admin.tabungan');
});

Route::middleware(['auth', 'role:nasabah'])->group(function () {
    Route::get('/nasabah/dashboard', function () {
        return view('nasabah.dashboard');
    })->name('nasabah.dashboard');
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
