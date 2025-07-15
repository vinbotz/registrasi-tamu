<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TamuController;
use App\Http\Controllers\AdminTamuController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate;

Route::get('/', function () {
    return redirect()->route('tamu.create');
});

Route::get('/tamu', [TamuController::class, 'create'])->name('tamu.create');
Route::get('/admin/tamu', [AdminTamuController::class, 'index'])->name('admin.tamu.index'); // Route untuk UI Admin
Route::post('/tamu', [TamuController::class, 'store'])->name('tamu.store');
Route::delete('/admin/tamu/{id}', [AdminTamuController::class, 'destroy'])->name('admin.tamu.destroy');
Route::get('/admin/tamu/{id}/edit', [AdminTamuController::class, 'edit'])->name('admin.tamu.edit');
Route::put('/admin/tamu/{id}', [AdminTamuController::class, 'update'])->name('admin.tamu.update');

Route::post('/admin/tamu/bulk-download', [AdminTamuController::class, 'bulkDownload'])->name('admin.tamu.bulk-download');

// Route Login Admin
Route::get('/admin/login', function () {
    return view('admin.login');
})->name('admin.login');

Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

Route::post('/admin/login', function (Request $request) {
    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended(route('admin.tamu.index'));
    }
    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ])->withInput();
})->name('admin.login.submit');

Route::post('/admin/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('admin.login');
})->name('admin.logout');

// Proteksi route admin dengan middleware auth
Route::middleware('auth')->group(function () {
    Route::get('/admin/tamu', [AdminTamuController::class, 'index'])->name('admin.tamu.index');
    Route::delete('/admin/tamu/{id}', [AdminTamuController::class, 'destroy'])->name('admin.tamu.destroy');
    Route::get('/admin/tamu/{id}/edit', [AdminTamuController::class, 'edit'])->name('admin.tamu.edit');
    Route::put('/admin/tamu/{id}', [AdminTamuController::class, 'update'])->name('admin.tamu.update');
    Route::post('/admin/tamu/bulk-download', [AdminTamuController::class, 'bulkDownload'])->name('admin.tamu.bulk-download');
});

// Set default redirect login ke admin.login
Authenticate::redirectUsing(function ($request) {
    return route('admin.login');
});
