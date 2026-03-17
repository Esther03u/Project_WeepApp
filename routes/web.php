<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\Admin\ActivityController as AdminActivityController;
use App\Http\Controllers\Admin\RegistrationController as AdminRegistrationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// หน้าแรก redirect ไปหน้ากิจกรรม
Route::get('/', function () {
    return redirect()->route('activities.index');
});

// Dashboard: redirect ตาม role
Route::get('/dashboard', function () {
    if (auth()->user()->isAdmin()) {
        return redirect()->route('admin.activities.index');
    }
    return redirect()->route('activities.index');
})->middleware(['auth', 'verified'])->name('dashboard');

// ---- User Routes ----
Route::get('/activities', [ActivityController::class, 'index'])->name('activities.index');
Route::get('/activities/{activity}', [ActivityController::class, 'show'])->name('activities.show');

Route::middleware('auth')->group(function () {
    Route::post('/activities/{activity}/register', [ActivityController::class, 'register'])->name('activities.register');
    Route::delete('/activities/{activity}/cancel', [ActivityController::class, 'cancel'])->name('activities.cancel');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ---- Admin Routes ----
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::resource('activities', AdminActivityController::class);
    Route::get('activities/{activity}/registrations', [AdminRegistrationController::class, 'index'])
        ->name('activities.registrations');
});

require __DIR__.'/auth.php';
