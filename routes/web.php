<?php

use App\Http\Controllers\PresenceController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
    Route::get('/presence', [PresenceController::class, 'index'])->name('presence.view');
    Route::post('/presence', [PresenceController::class, 'store'])->name('presence.store');
});
