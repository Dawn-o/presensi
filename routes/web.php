<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\RecapController;
use Illuminate\Support\Facades\Route;

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
});

Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return redirect()->route('presence.index');
    });
    
    Route::get('/presensi', [PresenceController::class, 'index'])->name('presence.index');
    Route::post('/presensi', [PresenceController::class, 'store'])->name('presence.store');
    Route::get('/presensi/rekap', [PresenceController::class, 'recap'])->name('presence.recap');
    Route::get('/rekap', [RecapController::class, 'index'])->name('presence.recap');
    
    Route::get('/izin', [LeaveRequestController::class, 'index'])->name('leaves.index');
    Route::post('/izin', [LeaveRequestController::class, 'store'])->name('leaves.store');
    
    Route::get('/karyawan', [EmployeeController::class, 'index'])->name('employees.index');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/persetujuan', [LeaveRequestController::class, 'approvals'])->name('leaves.approvals');
    Route::patch('/izin/{leave}/approve', [LeaveRequestController::class, 'approve'])->name('leaves.approve');
    Route::patch('/izin/{leave}/reject', [LeaveRequestController::class, 'reject'])->name('leaves.reject');
});